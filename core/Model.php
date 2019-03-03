<?php

namespace Core;

use Core\App;


class Model
{
    /**
     * Name of the DB table that the model is referring to.
     *
     * @var string
     */
    protected $table = null;

    /**
     * Name of the primary key field of the table that the database is referring
     * to.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * It stores the original content of the primary key field in order to
     * prevent that the ID of the model object can be changed.
     *
     * @var mixed
     */
    protected $originalKeyVal = null;

    /**
     * List of the model fields that can be automatically be filled in the
     * create and update methods.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * List of the model fields that will be stored and JSON.
     *
     * @var array
     */
    protected $jsonFields = [];

    /**
     * Set to TRUE if the model's table has the delete_at fields.
     * When TRUE the soft-deleted elements will be not selected.
     *
     * @var boolean
     */
    protected $deletedAt = false;

    /**
     * Is where the data of the model is stored.
     *
     * @var object
     */
    public $data = null;



    /**
     * Return the content of the original value go the primary key.
     *
     * @return mixed
     */
    public function getId()
    {
        if ($this->getKeyVal()) return $this->getKeyVal();

        $pk = $this->primaryKey;

        if ($pk and $this->data and $this->data->$pk) {
            return $this->data->$pk;
        }

        return null;
    }



    /**
     * Return the original key value.
     *
     * @return mixed
     */
    public function getKeyVal()
    {
        return $this->originalKeyVal;
    }



    /**
     * Create a new element in the database for an given KEY => VALUE array.
     *
     * @param array $data
     * @return static
     */
    public static function create($data)
    {
        $data = static::prepareData($data);

        $lastId = DB()->insert(static::getTableStatic(), $data, true);

        return static::find($lastId);
    }



    /**
     * Prepare given data to be stored in the DB: if there are fields listed in
     * $fillable then it will consider only the fillable fields and unset the
     * other fields.
     * Then it encodes to JSON the values for the fields pointed out in
     * $jsonFields.
     *
     * @param array $data
     * @return array
     */
    protected static function prepareData($data)
    {
        // considering only the $fillable fields if set
        $data = static::checkFillableData($data);

        // encoding the values for the fields pointed out in $jsonFields
        $data = static::encodeJsonFields($data);

        return $data;
    }



    /**
     * Encodes the value in $data depending on the list of fields in $jsonFields.
     *
     * @param array $data
     * @return array
     */
    protected static function encodeJsonFields($data)
    {
        $jsonFields = static::getJsonFieldsStatic();

        foreach ($jsonFields as $key) {
            if (array_key_exists($key, $data)) {
                $data[$key] = json_encode($data[$key]);
            }
        }

        return $data;
    }



    /**
     * If there are fields set in $fillable then it will unset all the keys
     * in the $data array that are not in $fillable.
     *
     * @param array $data
     * @return array
     */
    protected static function checkFillableData($data)
    {
        $fillable = static::getFillableStatic();

        if (count($fillable)) {
            foreach ($fillable as $key) {
                if (! array_key_exists($key, $data)) {
                    $data[$key] = null;
                }
            }

            foreach ($data as $key => $value) {
                if (! in_array($key, $fillable)) unset($data[$key]);
            }
        }

        return $data;
    }



    /**
     * Give back the item by a given ID.
     * By default the function will not consider the soft-deleted elements.
     *
     * @param mixed $id
     * @param boolean $excludeDeleted|false
     * @return static
     */
    public static function find($id, $excludeDeleted=true)
    {
        $model = new static;

        return $model->getModelItem($id, $excludeDeleted);
    }



    /**
     * Get the item with the given ID.
     *
     * @param mixed $id
     * @param boolean $excludeDeleted|false
     * @return static
     */
    protected function getModelItem($id, $excludeDeleted=true)
    {
        $this->data = null;
        $primaryKey = $this->primaryKey;

        $elements = $this->select(
            [
                'where' => "`{$this->table}`.`{$primaryKey}`=:element_id ",
                'limit' => 1,
            ],
            [
                'element_id' => $id
            ],
            ['excludeDeleted' => $excludeDeleted]
        );

        if (isset($elements[0])) {
            return $elements[0];
        }

        return null;
    }



    /**
     * Reset the data and the value of the primary key.
     *
     * @return void
     */
    private function resetData()
    {
        $this->originalKeyVal = null;

        $this->data = null;
    }



    /**
     * For the given data from the database it loads the model with those data.
     *
     * @param array $data
     * @return static
     */
    protected static function loadModelWithData($data)
    {
        $model = new static;

        $model->fillModelData($data);

        return $model;
    }



    /**
     * Perform the actual data filling for the model: first set the original
     * primary key value (in order to avoid that the ID can be altered) then
     * it decodes the fields that are in the JSON field list.
     *
     * @param array $data
     * @return void
     */
    public function fillModelData($data)
    {
        // setting the data
        $this->data = $data;

        // setting the originalKeyVal
        $this->setOriginaKeyValFromData();

        // decoding the fields $jsonFields
        $this->decodeJsonFields();
    }



    /**
     * Decodes the fields that are in the JSON field list $jsonFields.
     *
     * @return void
     */
    private function decodeJsonFields()
    {
        if (is_array($this->jsonFields) and count($this->jsonFields)) {
            foreach ($this->jsonFields as $key) {
                if (isset($this->data->$key) and $this->data->$key) {
                    $this->data->$key = @json_decode($this->data->$key, true);
                }
            }
        }
    }



    /**
     * Set the original primary key value in order to avoid that the ID can be
     * altered.
     *
     * @return void
     */
    private function setOriginaKeyValFromData()
    {
        $pk = $this->primaryKey;

        if ($this->data && isset($this->data->$pk)) {
            $this->originalKeyVal = $this->data->$pk;
        }
    }



    /**
     * Return the model data.
     *
     * @param boolean $returnArray|false
     * @return mixed
     */
    public function getData($returnArray=false)
    {
        if ($this->data and $returnArray) {
            return json_decode(json_encode($this->data), true);
        }

        return $this->data;
    }



    /**
     * Perform the select query in the DB selecting the elements for the given
     * clauses.
     *
     * @param array $clauses|[]     Contain the "where", "orderBy", ...
     * @param array $clauseData|[]  It may contain the data needed in the $clauses
     * @param array $settings|[]    Contain the settings for returns
     * @return mixed
     */
    public static function select($clauses=[], $clauseData=[], $settings=[])
    {
        $settings = static::setDefaultSettings($settings);

        $table = static::getTableStatic();
        $primaryKey = static::getPrimaryKeyStatic();

        $clauses = static::setDefaultClauses($clauses, $table, $primaryKey, $settings);

        // returning the SQL
        if ($settings['getQueryStr']) {
            return DB()->select($table, $clauses, $clauseData, $settings);
        }

        $result = DB()->select($table, $clauses, $clauseData);

        $collection = [];

        // by default each result of the query will be converted into the
        // istance of the Model
        if ($settings['loadModel']) {
            foreach ($result as $element) {
                $collection[] = static::loadModelWithData($element);
            }

            return $collection;
        }

        return $result;
    }



    /**
     * Set the default clauses: if the orderBy is not set then it will oreder by
     * the primary key DESC by default. By default it will excluded the
     * soft-deleted elements if the $deletedAt is set,
     *
     * @param array $clauses
     * @param string $table
     * @param string $primaryKey
     * @param array $settings
     * @return array
     */
    protected static function setDefaultClauses($clauses, $table, $primaryKey, $settings)
    {
        if (empty($clauses['orderBy'])) {
            $clauses['orderBy'] = "`$table`.`$primaryKey` DESC ";
        }

        if (static::hasDeletedAtStatic()) {
            if ($settings['excludeDeleted']) {
                if (! empty($clauses['where'])) $clauses['where'] = ' ('.$clauses['where'].') AND ';
                else $clauses['where'] = '';

                $clauses['where'] .= " `$table`.`deleted_at` IS NULL ";
            }
        }

        return $clauses;
    }



    /**
     * Set the default settings for the select query.
     * By default it will convert each result into the instance of the
     * instanciated model (loadModel=true) and it will excluded the soft-deleted
     * elements.
     *
     * @param array $settings|[]
     * @return void
     */
    protected static function setDefaultSettings($settings=[])
    {
        if (! array_key_exists('excludeDeleted', $settings)) $settings['excludeDeleted'] = true;
        if (! array_key_exists('loadModel', $settings)) $settings['loadModel'] = true;
        if (! array_key_exists('getQueryStr', $settings)) $settings['getQueryStr'] = false;

        return $settings;
    }



    /**
     * Select only the first element for the given query clauses.
     *
     * @param array $clauses|[]
     * @param array $clauseData|[]
     * @param array $settings|[]
     * @return mixed
     */
    public static function selectFirst($clauses=[], $clauseData=[], $settings=[])
    {
        $clauses['limit'] = 1;

        $res = static::select($clauses, $clauseData, $settings);

        // returning the query string if required
        if (isset($settings['getQueryStr']) and $settings['getQueryStr']) {
            return $res;
        }

        if ($res and isset($res[0])) return $res[0];

        return null;
    }



    /**
     * Perform the query count for the given clauses.
     *
     * @param array $clauses|[]
     * @param array $clauseData|[]
     * @param array $settings|[]
     * @return numeric
     */
    public static function count($clauses=[], $clauseData=[], $settings=[])
    {
        $settings['loadModel'] = false;

        $clauses['select'] = 'COUNT(*) as total';

        $res = static::select($clauses, $clauseData, $settings);

        if ($res and isset($res[0])) return $res[0]->total;

        return null;
    }



    /**
     * Insert a new element for the goven data.
     *
     * @param Class $parameter
     * @return void
     */
    public static function insert($data=[])
    {
        $data = static::prepareData($data);

        return DB()->insert(static::getTableStatic(), $data);
    }



    /**
     * Store in the data model the given data as parameter and then save the
     * element in the database.
     *
     * @param array $data|null
     * @param boolean $forceRewriteId|false
     * @return void
     */
    public function save($data=null, $forceRewriteId=false)
    {
        // replacing the values in the data of the model ($this->data) just for
        // the keys are in the $data array as well.
        if ($this->data and $data and is_array($data)) {
            foreach ($this->data as $key => $value) {
                if (array_key_exists($key, $data)) {
                    $this->data->$key = $data[$key];
                }
            }
        }

        // perform the saving
        return $this->saveModel($forceRewriteId);
    }



    /**
     * Perform the saving of the data in the model into the database.
     *
     * @param boolean $forceRewriteId|false
     * @return boolean
     */
    public function saveModel($forceRewriteId=false)
    {
        if (! $this->data) return false;

        $parameters = $this->getData(true);
        $parameters = static::encodeJsonFields($parameters);

        if (! $forceRewriteId) {
            if (isset($parameters[$this->primaryKey])) unset($parameters[$this->primaryKey]);
        }

        $caluseData['original_id'] = $this->getKeyVal();

        return DB()->update($this->table, $parameters, [
            'where' => " `$this->table`.`{$this->primaryKey}`=:original_id "
        ], $caluseData);
    }



    /**
     * Wrapper arount the function save: it saves the element data without
     * protecting the primary key value.
     *
     * @param array $data|null
     * @return boolean
     */
    public function saveForceRewiteId($data=null)
    {
        return $this->save($data, true);
    }



    /**
     * Update the element data in the database.
     *
     * @param array $parameters
     * @param array $clauses|[]
     * @param array $caluseData|[]
     * @return boolean
     */
    public static function update($parameters, $clauses=[], $caluseData=[])
    {
        return DB()->update(
            static::getTableStatic(),
            $parameters,
            $clauses,
            $caluseData
        );
    }



    /**
     * If the $deletedAt is true then it will perform the soft-delete otherwise
     * it will delete the element from the database.
     *
     * @return boolean
     */
    public function delete()
    {
        if ($this->deletedAt) {
            $deletedAt = date('Y-m-d H:i:s');

            $this->data->deleted_at = $deletedAt;

            $res = DB()->update($this->table,
                [ 'deleted_at' => $deletedAt ],
                [ 'where' => " `$this->table`.`{$this->primaryKey}`=:original_id "],
                [ 'original_id' => $this->getKeyVal() ]
            );

            $this->resetData();

            return $res;
        }

        return $this->forceDelete();
    }



    /**
     * Delete the element from the database skipping the soft-delete check.
     *
     * @return boolean
     */
    public function forceDelete()
    {
        if ($this->data and $this->getKeyVal()) {
            $res = DB()->delete(
                $this->table,
                [
                    'where' => " `{$this->table}`.`{$this->primaryKey}`=:original_id ",
                ],
                [
                    'original_id' => $this->getKeyVal()
                ]
            );

            $this->resetData();

            return $res;
        }

        return false;
    }



    /**
     * Static method to check if the model has set the deletedAt.
     *
     * @return boolean
     */
    public static function hasDeletedAtStatic()
    {
        $model = new static;

        return $model->hasDeletedAt();
    }



    /**
     * Check if the model has set the deletedAt.
     *
     * @return boolean
     */
    public function hasDeletedAt()
    {
        return $this->deletedAt;
    }



    /**
     * Static method to return the JSON fields.
     *
     * @return boolean
     */
    public static function getJsonFieldsStatic()
    {
        $model = new static;

        return $model->getJsonFields();
    }



    /**
     * Return the JSON field list.
     *
     * @return boolean
     */
    public function getJsonFields()
    {
        return $this->jsonFields;
    }



    /**
     * Static method that returns the DB table name related to the model.
     *
     * @return boolean
     */
    public static function getTableStatic()
    {
        $model = new static;

        return $model->getTable();
    }




    /**
     * Return the DB table name related to the model.
     *
     * @return boolean
     */
    public function getTable()
    {
        return $this->table;
    }



    /**
     * Static method that return the fillable field list.
     *
     * @return boolean
     */
    public static function getFillableStatic()
    {
        $model = new static;

        return $model->getFillable();
    }



    /**
     * Return the fillable field list.
     *
     * @return boolean
     */
    public function getFillable()
    {
        return $this->fillable;
    }



    /**
     * Static method that returns the name of the primary key field.
     *
     * @return boolean
     */
    public static function getPrimaryKeyStatic()
    {
        $model = new static;

        return $model->getPrimaryKey();
    }



    /**
     * Return the name of the primary key field.
     *
     * @return boolean
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }



    /**
     * It performs the select and it paginates the result.
     *
     * @param array $clauses|[]
     * @param array $clauseData|[]
     * @param array $settings|[]
     * @return array
     */
    public static function paginate($clauses=[], $clauseData=[], $settings=[])
    {
        $params = static::setPaginationDefaultParameters();

        extract(static::setGenericSearchQuery($clauses, $clauseData, $params['search'], $settings));

        $clauses['limit'] = $params['limit'];

        if (isset($params['order_by']) and $params['order_by']) {
            $clauses['orderBy'] = $params['order_by'] . " " . $params['order_by_mode'];
        }

        $offset = $params['limit'] * ($params['page'] - 1);
        if ($offset > 0) {
            $clauses['offset'] = $offset;
        }

        $result = static::select($clauses, $clauseData, $settings);

        return [
            'result' => $result,
            'pagination' => static::getPagination($params, $clauses, $clauseData, $settings),
        ];
    }



    /**
     * Set in the clauses the generic search query.
     * It search the given string $strToSearch in the filed list $settings['searchable']
     * (if is set) otherwise it will search in all $fillable fields.
     *
     * @param array $clauses
     * @param array $clauseData
     * @param string $strToSearch
     * @param array $settings
     * @return array
     */
    private static function setGenericSearchQuery($clauses, $clauseData, $strToSearch, $settings=[])
    {
        if (! empty($strToSearch)) {
            if (isset($settings['searchable'])) {
                $fields = $settings['searchable'];
            }
            else $fields = static::getFillableStatic();

            if (is_array($fields) and count($fields)) {
                $searchClause = '';

                foreach ($fields as $field) {
                    $searchClause .= " $field LIKE '%$strToSearch%' OR ";
                }

                $searchClause = rtrim($searchClause, 'OR ');

                if (! empty($clauses['where'])) {
                    $clauses['where'] = '(' . $clauses['where'] . ") AND ( $searchClause )";
                }
                else {
                    $clauses['where'] = "( $searchClause )";
                }
            }
        }

        return [
            'clauses' => $clauses,
            'clauseData' => $clauseData,
        ];
    }



    /**
     * Set the default pagination parameters if they are not found in the
     * request parameters.
     *
     * @return array
     */
    private static function setPaginationDefaultParameters()
    {
        $limit = request('get', 'limit', 10);
        $page = request('get', 'page', 0);
        $orderBy = request('get', 'order_by');
        $orderByMode = request('get', 'order_by_mode');
        $search = request('get', 'search');

        if (!is_numeric($page) or ($page < 1) or empty($page)) $page = 1;
        if (!is_numeric($limit) or ($limit < 10) or ($limit > 500)) $limit = 50;
        if (empty($orderBy)) $orderBy = null;
        if (empty($orderByMode)) $orderByMode = null;
        if (empty($search)) $search = null;

        return [
            'limit' => $limit,
            'page' => $page,
            'order_by' => $orderBy,
            'order_by_mode' => $orderByMode,
            'search' => $search,
        ];
    }



    /**
     * Return the pagination information like as the current page, the links
     * of all the pages, the total pages and the total elements in the result.
     *
     * @param array $params
     * @param array $clauses
     * @param array $clauseData
     * @param array $selectSett
     * @return array
     */
    private static function getPagination($params, $clauses, $clauseData, $selectSett)
    {
        $page = $params['page'];

        unset($clauses['limit']);
        unset($clauses['offset']);
        unset($clauses['orderBy']);

        $totalElem = static::count($clauses, $clauseData, $selectSett);
        $totalPages = ceil($totalElem / $params['limit']);

        if ($page > $totalPages) $page = $totalPages;

        return [
            'totalElements' => $totalElem,
            'totalPages' => $totalPages,
            'current' => $page,
            'next' => ($page+1) <= $totalPages ? ($page+1) : null,
            'prev' => ($page-1) > 0 ? ($page-1) : null,
            'links' => static::getPaginationLinks($params, $totalPages),
        ];
    }



    /**
     * It builds the list of the links for each page in the result.
     *
     * @param array $params
     * @param array $totalPages
     * @return array
     */
    private static function getPaginationLinks($params, $totalPages)
    {
        $links = [];

        $getParams = request('get');
        foreach ($params as $key => $value) {
            if (empty($value)) continue;

            $getParams[$key] = $value;
        }

        for($i=1; $i<=$totalPages; $i++) {
            $getParams['page'] = $i;
            $links[$i] = get_current_uri($getParams);
        }

        return $links;
    }
}

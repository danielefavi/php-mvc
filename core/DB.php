<?php

namespace Core;

use PDO;
use PDOException;


/**
 * Manage the interactions with the database and execute the statements/
 */
class DB
{
    /**
     * Keep the PDO object.
     *
     * @var object
     */
    protected $pdo;



    /**
     * Initialize the PDO database connection.
     *
     * @param array $config
     * @return void
     */
    public function __construct($config)
    {
        try {
            $this->pdo = new PDO(
                $config['connection'].';dbname='.$config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }



    /**
     * Generate the SQL for the select statement for a given table and
     * clauses.
     *
     * @param string $table
     * @param array $clauses|[]
     * @return string
     */
    public function getSelectQueryStr($table, $clauses=[])
    {
        $select = '*';
        if (isset($clauses['select'])) {
            $select = $clauses['select'];
        }

        $query = "
            SELECT $select
            FROM `". $table ."`
        ";

        if (isset($clauses['join'])) {
            $query .= $clauses['join'] . " \n ";
        }

        if (isset($clauses['where'])) {
            $query .= 'WHERE ' . $clauses['where'] . " \n ";
        }

        if (isset($clauses['groupBy'])) {
            $query .= 'GROUP BY ' . $clauses['groupBy'] . " \n ";
        }

        if (isset($clauses['orderBy'])) {
            $query .= 'ORDER BY ' . $clauses['orderBy'] . " \n ";
        }

        if (isset($clauses['limit'])) {
            $query .= 'LIMIT ' . abs($clauses['limit']) . " \n ";
        }

        if (isset($clauses['offset'])) {
            $query .= 'OFFSET ' . abs($clauses['offset']) . " \n ";
        }

        return $query;
    }



    /**
     * Perform the select for a given table and clauses.
     *
     * @param string $table
     * @param array $clauses|[]
     * @param array $clauseData|[]
     * @return stdClass
     */
    public function select($table, $clauses=[], $clauseData=[], $settings=[])
    {
        $queryStr = $this->getSelectQueryStr($table, $clauses);

        if (isset($settings['getQueryStr']) and $settings['getQueryStr']) {
            return $queryStr;
        }

        $statement = $this->execute($queryStr, $clauseData, true);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }



    /**
     * Perform the select and return the first element only.
     *
     * @param string $table
     * @param array $clauses|[]
     * @param array $clauseData|[]
     * @return stdClass
     */
    public function selectFirst($table, $clauses=[], $clauseData=[])
    {
        $clauses['limit'] = '1';

        $res = $this->select($table, $clauses, $clauseData);

        if (isset($res[0])) return $res[0];

        return null;
    }



    /**
     * Perform the count on a given table.
     *
     * @param string $table
     * @param array $clauses|[]
     * @param array $clauseData|[]
     * @return numeric
     */
    public function count($table, $clauses=[], $clauseData=[])
    {
        unset($clauses['groupBy']);
        unset($clauses['orderBy']);

        $clauses['select'] = 'COUNT(*) as total_count_aggr';

        $res = $this->select($table, $clauses, $clauseData);

        if ($res and isset($res[0])) return $res[0]->total_count_aggr;

        return null;
    }



    /**
     * Perform the update statement.
     *
     * @param  string $table
     * @param  array  $parameters
     * @param  array  $clauses|[]
     * @param  array  $caluseData|[]
     * @return boolean
     */
    public function update($table, $parameters, $clauses=[], $caluseData=[])
    {
        $sql = "update `{$table}` set ";

        foreach ($parameters as $key => $value) {
            $sql .= " {$key}=:{$key},";
        }

        $sql = rtrim($sql, ',');

        if (isset($clauses['where'])) {
            $sql .= ' WHERE ' . $clauses['where'];
        }

        return $this->execute(
            $sql,
            array_merge($parameters, $caluseData)
        );
    }



    /**
     * Insert a record into a table.
     *
     * @param  string $table
     * @param  array  $parameters
     * @param  boolean  $withLastInsertedId|false
     * @return mixed
     */
    public function insert($table, $parameters, $withLastInsertedId=false)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        $result = $this->execute(
            $sql,
            $parameters
        );

        if ($withLastInsertedId) {
            return $this->pdo->lastInsertId();
        }

        return $result;
    }



    /**
     * Delete a record.
     *
     * @param  string $table
     * @param  array  $clauses|[]
     * @param  array  $caluseData|[]
     * @return boolean
     */
    public function delete($table, $clauses=[], $caluseData=[])
    {
        $sql = "delete from `{$table}` ";

        if (isset($clauses['where'])) {
            $sql .= ' WHERE ' . $clauses['where'];
        }

        return $this->execute(
            $sql,
            $caluseData
        );
    }



    /**
     * Execute the SQL statement.
     *
     * @param string $sql
     * @param array $data|[]
     * @param boolean $returnStatement|false
     * @return mixed
     */
    private function execute($sql, $data=[], $returnStatement=false)
    {
        $statement = $this->pdo->prepare($sql);

        $result = $statement->execute($data);

        if ($returnStatement) return $statement;

        return $result;
    }



    /**
     * Execute a raw SQL.
     *
     * @param string $sql
     * @return array
     */
    public function raw($sql)
    {
        $statement = $this->pdo->prepare($sql);

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }






    /**
     * It performs the select and it paginates the result.
     *
     * @param stirng $table
     * @param array $clauses|[]
     * @param array $clauseData|[]
     * @param array $settings|[]
     * @return array
     */
    public function paginate($table, $clauses=[], $clauseData=[], $settings=[])
    {
        $params = $this->setPaginationDefaultParameters();

        extract($this->setGenericSearchQuery($clauses, $clauseData, $params['search'], $settings));

        $clauses['limit'] = $params['limit'];

        if (isset($params['order_by']) and $params['order_by']) {
            $clauses['orderBy'] = $params['order_by'] . " " . $params['order_by_mode'];
        }

        $offset = $params['limit'] * ($params['page'] - 1);
        if ($offset > 0) {
            $clauses['offset'] = $offset;
        }

        $result = $this->select($table, $clauses, $clauseData, $settings);

        if (isset($settings['getQueryStr']) and $settings['getQueryStr']) {
            return $result;
        }

        return [
            'result' => $result,
            'pagination' => $this->getPagination($table, $params, $clauses, $clauseData, $settings),
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
    private function setGenericSearchQuery($clauses, $clauseData, $strToSearch, $settings=[])
    {
        if (! empty($strToSearch)) {
            $fields = isset($settings['searchable']) ? $settings['searchable'] : [];

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
    private function setPaginationDefaultParameters()
    {
        $limit = request()->get('limit', 50);
        $page = request()->get('page', 0);
        $orderBy = request()->get('order_by');
        $orderByMode = request()->get('order_by_mode');
        $search = request()->get('search');

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
     * @param string $table
     * @param array $params
     * @param array $clauses
     * @param array $clauseData
     * @param array $selectSett
     * @return array
     */
    private function getPagination($table, $params, $clauses, $clauseData, $selectSett)
    {
        $page = $params['page'];

        unset($clauses['limit']);
        unset($clauses['offset']);
        unset($clauses['orderBy']);

        $totalElem = $this->count($table, $clauses, $clauseData);
        $totalPages = ceil($totalElem / $params['limit']);

        if ($page > $totalPages) $page = $totalPages;

        return [
            'totalElements' => $totalElem,
            'totalPages' => $totalPages,
            'current' => $page,
            'next' => ($page+1) <= $totalPages ? ($page+1) : null,
            'prev' => ($page-1) > 0 ? ($page-1) : null,
            'links' => $this->getPaginationLinks($params, $totalPages),
        ];
    }



    /**
     * It builds the list of the links for each page in the result.
     *
     * @param array $params
     * @param array $totalPages
     * @return array
     */
    private function getPaginationLinks($params, $totalPages)
    {
        $links = [];

        $getParams = request()->get(null, []);

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

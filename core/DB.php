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

}

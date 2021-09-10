<?php


namespace aps\model\repository;

use aps\appcore\Conn;
use aps\appcore\Logger;
use Exception;

class crud
{
    private $table;
    private $result;
    use Logger;


    public function insert($table, array $args)
    {
        $this->table = (string) $table;
        $keys =  implode(', ', array_keys($args));
        $values = ":" . implode(', :', array_keys($args));
        $query = "INSERT INTO $this->table ({$keys}) VALUES ({$values})";

        try {
            $this->result = Conn::run($query, $args);
            if (isset($this->result->queryString) && $this->result->queryString == $query){
                $this->result = true;
            }
        } catch (Exception $e) {
            $this->result = $e->getMessage ();
        }
        return $this->result;
    }

    public function read($table, $args, $parse = null, array $colunn = null)
    {
        $this->table = (string) $table;

        if (!is_null($colunn)){
            $fields = implode(', ', $colunn);
        } else {
            $fields = '*';
        }

        if (!empty($parse)):
            parse_str($parse, $param);
        else:
            $param = null;
        endif;


        $query = "SELECT {$fields} FROM {$this->table} {$args}";

        try
        {
            $this->result = conn::run($query, $param)->fetchAll();
        } catch (Exception $e) {
            $this->result = array("Erro" => $e.getMessage());
        }
        return $this->result;
    }

    public function update($table, array $args, array $cond)
    {

        $this->table = (string) $table;
        $values = '';

        foreach ($args as $key => $value) {
            $values .= ($values === '' ? $key . "=:" . $key : ", " .  $key . "=:" . $key);
        }

        if (sizeof($cond) > 1){
            $where = '';
            foreach ($cond as $key => $v) {
                $where .= ($where === '' ? $key . "=:" . $key : " AND " .  $key . "=:" . $key);
            }
        } else {
            $where = key($cond) . "=:" . key($cond);
        }

        $pdovalues = array_merge($args, $cond);
        $query = "UPDATE {$this->table} SET {$values} WHERE $where";

        try
        {
            $this->result = conn::run($query, $pdovalues);
            if (isset($this->result->queryString) && $this->result->queryString == $query){
                $this->result = true;
            }
        } catch (Exception $e) {
            $this->result = array("Erro" => $e.getMessage());
        }
        return $this->result;
    }

    public function delete($table, array $cond)
    {

        $this->table = (string) $table;

        if (sizeof($cond) > 1){
            $where = '';
            foreach ($cond as $key => $v) {
                $where .= ($where === '' ? $key . "=:" . $key : " AND " .  $key . "=:" . $key);
            }
        } else {
            $where = key($cond) . "=:" . key($cond);
        }

        $query = "DELETE FROM {$this->table} WHERE $where";

        try
        {
            $this->result = conn::run($query, $cond)->rowCount();
            if ($this->result > 0){
                $this->result = true;
            } else {
                $this->result = false;
            }
        } catch (Exception $e) {
            $this->result = array("Erro" => $e.getMessage());
        }
        return $this->result;
    }
}

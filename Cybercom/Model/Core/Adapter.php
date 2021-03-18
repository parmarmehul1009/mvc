<?php

namespace Model\Core;

class Adapter
{
    var $config = [
        'host' => 'localhost',
        'user' => 'root',
        'password' => '',
        'database' => 'cybercom'
    ];
    private $connect = null;
    function connection()
    {
        $connect = mysqli_connect($this->config['host'], $this->config['user'], $this->config['password'], $this->config['database']);
        $this->setConnect($connect);
    }

    function getConnect()
    {
        return $this->connect;
    }

    function setConnect(\mysqli $connect)
    {
        $this->connect = $connect;
        return $this;
    }

    function isConnected()
    {
        if (!$this->getConnect()) {
            return false;
        }
        return true;
    }
    function error($errno, $error, $query)
    {
        echo "<div style='background-color:#faa'>";
        echo "<h4 style='background-color:#f00'>" . $errno . "-" . $error . "</h4>";
        echo $query;
        echo "</div>";
        exit;
    }

    function select($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query) or $this->error($this->getConnect()->errno, $this->getConnect()->error, $query);
        return $result;
    }
    function insert($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query) or $this->error($this->getConnect()->errno, $this->getConnect()->error, $query);
        if ($result) {
            return  $this->getConnect()->insert_id;
        }
        return $result;
    }

    function update($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query) or $this->error($this->getConnect()->errno, $this->getConnect()->error, $query);
        return $result;
    }

    function delete($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query) or $this->error($this->getConnect()->errno, $this->getConnect()->error, $query);
        return $result;
    }

    function fetchRow($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query) or $this->error($this->getConnect()->errno, $this->getConnect()->error, $query);
        $row = $result->fetch_assoc();
        if (!$row) {
            return false;
        }
        return $row;
    }

    function fetchAll($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query) or $this->error($this->getConnect()->errno, $this->getConnect()->error, $query);
        $rows = $result->fetch_all($resulttype = MYSQLI_ASSOC);
        if (!$rows) {
            return false;
        }
        return $rows;
    }

    public function fetchPairs($query)
    {
        if (!$this->isConnected()) {
            $this->connection();
        }
        $result = $this->getConnect()->query($query) or $this->error($this->getConnect()->errno, $this->getConnect()->error, $query);
        $rows = $result->fetch_all();
        if (!$rows) {
            return $rows;;
        }
        $columns = array_column($rows, '0');
        $values = array_column($rows, '1');
        return array_combine($columns, $values);
    }
}

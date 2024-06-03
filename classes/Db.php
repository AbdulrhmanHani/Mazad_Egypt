<?php

namespace MazadEgypt\Classes;

abstract class Db
{

    protected $conn;
    protected $table;

    public function connect()
    {
        $this->conn = mysqli_connect(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
    }


    public function selectAll(string $fields = "*"): array
    {
        $sql = "SELECT $fields FROM $this->table";
        $result = mysqli_query($this->conn, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    public function selectId($id, string $fields = "*")
    {
        $sql = "SELECT $fields FROM $this->table WHERE id = $id";
        $result = mysqli_query($this->conn, $sql);

        return mysqli_fetch_assoc($result);
    }


    public function selectWhere($conds, string $fields = "*"): array
    {
        $sql = "SELECT $fields FROM $this->table WHERE $conds";
        $result = mysqli_query($this->conn, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    public function selectWhereId($id, string $conds): array
    {
        $sql = "SELECT $id FROM $this->table WHERE $conds";
        $result = mysqli_query($this->conn, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }


    public function getCount(): int
    {
        $sql = "SELECT COUNT(*) AS cnt FROM $this->table";
        $result = mysqli_query($this->conn, $sql);

        return mysqli_fetch_assoc($result)['cnt'];
    }


    public function getCountReason($conds): int
    {
        $sql = "SELECT COUNT(*) AS cnt FROM $this->table where $conds";
        $result = mysqli_query($this->conn, $sql);

        return mysqli_fetch_assoc($result)['cnt'];
    }


    public function insert(string $fields, string $values): bool
    {
        $sql = "INSERT INTO $this->table ($fields) VALUES ($values)";
        return mysqli_query($this->conn, $sql);
    }


    public function getCountEmail($conds): int
    {
        $sql = "SELECT COUNT(*) AS cnt FROM $this->table WHERE email = '$conds'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result)['cnt'];
    }


    public function getCountUser($conds): int
    {
        $sql = "SELECT COUNT(*) AS cnt FROM $this->table WHERE `name` = '$conds'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result)['cnt'];
    }


    public function getCountCreditCard($conds): int
    {
        $sql = "SELECT COUNT(*) AS cnt FROM $this->table WHERE `visa_card` = '$conds'";
        $result = mysqli_query($this->conn, $sql);
        return mysqli_fetch_assoc($result)['cnt'];
    }


    public function insertAndGetId(string $fields, string $values)
    {
        $sql = "INSERT INTO $this->table ($fields) VALUES ($values)";
        mysqli_query($this->conn, $sql);
        return mysqli_insert_id($this->conn);
    }


    public function update($set, $val, $id): bool
    {
        $sql = "UPDATE $this->table SET $set = $val WHERE id = $id";
        return mysqli_query($this->conn, $sql);
    }


    public function join($join, $conds, string $fields = "*")
    {
        $sql = "SELECT $fields FROM $this->table JOIN $join ON $this->table.$conds";
        return mysqli_query($this->conn, $sql);
    }


    public function delete($id): bool
    {
        $sql = "DELETE FROM $this->table WHERE id = $id";
        return mysqli_query($this->conn, $sql);
    }

    public function checks0()
    {
        $sql = "SET FOREIGN_KEY_CHECKS=0";
        return mysqli_query($this->conn, $sql);
    }


    public function checks1()
    {
        $sql = "SET FOREIGN_KEY_CHECKS=1";
        return mysqli_query($this->conn, $sql);
    }
}

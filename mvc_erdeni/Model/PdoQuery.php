<?php
/**
 * Created by PhpStorm.
 * User: erdeni
 * Date: 14.12.18
 * Time: 16:06
 */

namespace mvc_erdeni\Model {

    class PdoQuery
    {

         /** Вставка новой строки в таблицу
         * @param $tableName
         * @param $arrayData
         */
        public function insert($tableName, $arrayData) : int {

            try {
                $pdo = SingletonDataBase::getInstance();
                $sql = "INSERT INTO " . $tableName . " (";
                $i = 0;
                foreach ($arrayData as $key => $value) {
                    if ($i > 0) {
                        $sql .= ',';
                    }
                    $sql .= $key;
                    $i++;
                }
                $sql .= ") VALUES (";
                $i = 0;
                foreach ($arrayData as $key => $value) {
                    if ($i > 0) {
                        $sql .= ',';
                    }
                    $sql .= ":" . $key;
                    $i++;
                }
                $sql .= ")";
                $stmt = $pdo->prepare($sql);
                $stmt->execute($arrayData);
                return $pdo->lastInsertId();
            }
            catch (\PDOException $pe) {
                return -1;
            }
        }

        public function insert_on_duplicate_key_update($tableName, $arrayData, $updatingData) : int {

            try {
                $pdo = SingletonDataBase::getInstance();
                $sql = "INSERT INTO " . $tableName . " (";
                $i = 0;
                foreach ($arrayData as $key => $value) {
                    if ($i > 0) {
                        $sql .= ',';
                    }
                    $sql .= $key;
                    $i++;
                }
                $sql .= ") VALUES (";
                $i = 0;
                foreach ($arrayData as $key => $value) {
                    if ($i > 0) {
                        $sql .= ',';
                    }
                    $sql .= ":" . $key;
                    $i++;
                }
                $sql .= ") ON DUPLICATE KEY UPDATE ";
                $i = 0;
                foreach ($updatingData as $key => $value) {
                    if ($i > 0) {
                        $sql .= ',';
                    }
                    $sql .= ":" . $key;
                    $i++;
                }
                $stmt = $pdo->prepare($sql);
                $stmt->execute($arrayData);
                return $pdo->lastInsertId();
            }
            catch (\PDOException $pe) {
                return -1;
            }
        }

        /** выполнить одиночный запрос
         * @param $statement
         * @return int
         */
        public function exec($statement) {
            return SingletonDataBase::getInstance()->exec($statement);
        }


        /**
         * [getRowObject description]
         * @param  [string] $sqlQuery    [description]
         * @param  [assoc array] $paramsArray [description]
         * @return [object]              [description]
         */
        public function fetch($sqlQuery, $paramsArray)
        {
            $pdo = SingletonDataBase::getInstance();
            try {
                $pdoStatement = $pdo->prepare($sqlQuery);
                $settings = $pdoStatement->setFetchMode(\PDO::FETCH_BOTH);
                $zapros = $pdoStatement->execute($paramsArray);
                $result = $pdoStatement->fetch(\PDO::FETCH_BOTH);
                $pdoStatement->closeCursor();
                return $result;
            } catch (\PDOException $pe) {
                return $pe;
            }
        }

        /**
         * [getAllRows description]
         * @param  [type] $sqlQuery    [description]
         * @param  [type] $paramsArray [description]
         * @return [fetch array of arrays]  [description]
         */
        public function fetchAll($sqlQuery, $paramsArray)
        {
            $pdo = SingletonDataBase::getInstance();
            try {
                $pdoStatement = $pdo->prepare($sqlQuery);
                $settings = $pdoStatement->setFetchMode(\PDO::FETCH_BOTH);
                $zapros = $pdoStatement->execute($paramsArray);
                $result = $pdoStatement->fetchAll();
                $pdoStatement->closeCursor();
                return $result;
            } catch (\PDOException $pe) {
                return $pe;
            }
        }

        /**
         * @return bool
         */
        public function beginTransaction() {
            return SingletonDataBase::getInstance()->beginTransaction();
        }

        /**
         * @return bool
         */
        public function commit() {
            return SingletonDataBase::getInstance()->commit();
        }

        /**
         * @return bool
         */
        public function rollBack() {
            return SingletonDataBase::getInstance()->rollBack();
        }

    }
}
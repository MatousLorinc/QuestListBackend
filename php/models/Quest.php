<?php
class Quest {
    const TABLE_NAME = 'quests';
    public $quest_id;
    public $name;
    public $type;
    public $start;
    public $end;

    public function setQuest($name,$type,$start,$end){
        $this->name = $name;
        $this->type = $type;
        $this->start = $start;
        $this->end = $end;
    }

    public static function getQuests($conn){
        $stmt = $conn->query('SELECT 
                    quests.id,
                    quests.name,
                    quest_types.name AS type,
                    quests.start,
                    quests.end
                    FROM
                    '.self::TABLE_NAME.'
                    LEFT JOIN
                    quest_types ON quests.quest_type_id = quest_types.quest_type_id
                    ');
        $stmt->setFetchMode(PDO::FETCH_INTO, new Quest);
        $stmt->execute();
        return $stmt;
    }

    public static function deleteQuest($conn,$ids_to_delete){
        $id_to_delete;
        try {
            $stmt = $conn->prepare('DELETE FROM '.self::TABLE_NAME.' WHERE id=(:id)');
            $stmt->bindParam(':id', $id_to_delete);
            foreach ($ids_to_delete as $item) {
                $id_to_delete = $item;
                //echo $id_to_delete;
                $stmt->execute();
            }
            return true;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function insertQuest($conn){
        try {
            $stmt = $conn->prepare('INSERT INTO '.self::TABLE_NAME.' 
                                    (name, 
                                    quest_type_id, 
                                    start, 
                                    end) 
                                    VALUES (:name, :type, :start, :end)');
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':type', $this->type);
            $stmt->bindParam(':start', $this->start);
            $stmt->bindParam(':end', $this->end);
            $stmt->execute();
            return true;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
}
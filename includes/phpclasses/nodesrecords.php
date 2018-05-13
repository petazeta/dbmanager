<?php
class NodeFemaleRecords extends NodeFemale {
  //female
  function db_loadrecords($link="load all"){
    switch ($link) {
      case "load tables":
        $sql = "SHOW TABLES";
        break;
      case "load linked":
        $sql = "SELECT t.* FROM "
          . TABLE_LINKS . " l"
          . " inner join " . TABLE_RELATIONSHIPS . " r on l.relationships_id=r.id"
          . " inner join " . constant($this->properties->childtablename) . " t on t.id=l.child_id"
          . " WHERE r.id=" . $this->properties->id;
        break;
      case "load unlinked":
        $sql = "SELECT t.* FROM "
          .  constant($this->properties->childtablename) . " t" 
          . " where t.id not in ("
          .  "SELECT t.id FROM "
            . constant($this->properties->childtablename) . " t "
            . " inner join " . TABLE_LINKS . " l on l.relationships_id=" . $this->properties->id . " and t.id=l.child_id"
            . " WHERE 1"
          . ")";
        break;
      case "load my children not":
        $sql = "SELECT t.* FROM "
        .  constant($this->properties->childtablename) . " t" 
        . " where t.id not in ("
          . "SELECT l.child_id FROM "
          .  TABLE_LINKS . " l"
          . " where " . "l.relationships_id='" . $this->properties->id . "'"
          . " and l.parent_id=" . $this->partnerNode->properties->id
        . ")"; 
        break;
      default:
        $sql = "SELECT t.* FROM "
          .  constant($this->properties->childtablename) . " t";
    }
    if (($result = $this->getdblink()->query($sql))===false) return false;
    for ($i=0; $i<$result->num_rows; $i++) {
      $row=$result->fetch_array(MYSQLI_ASSOC);
      if (isset($row["sort_order"])) unset($row["sort_order"]);
      $this->children[$i] = new NodeMale();
      $this->children[$i]->properties->cloneFromArray($row);
      $this->children[$i]->parentNode=$this;
    }
  }
  
  function db_loadthisrel()  {
    $this->db_loadchildtablekeys();
    $sql = "SELECT r.* FROM "
      . TABLE_RELATIONSHIPS . " r"
      . " WHERE" . " r.parenttablename='" . $this->properties->parenttablename . "'"
      . " AND " . " r.childtablename='" . $this->properties->childtablename . "'";
    if (($result = $this->getdblink()->query($sql))===false) return false;
    else if ($result->num_rows==1) {
      $row=$result->fetch_array(MYSQLI_ASSOC);
      $this->properties->cloneFromArray($row);
    }
  }
}
?>
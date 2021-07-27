<?php
namespace App\Models;

class DB {

	static public $aConn = Array();//공용 커넥션
	protected $sTableName;
	protected $aSelect = "*"; /* Array ( column ) */
	protected $aWhere; /* Array ( where ) implode and */
	protected $aJoin; /* Array ( Array ( tablename => tablename,where => Array ( where ) , alias => alias , type => jointype ) */
	protected $aGroup; /* Array ( column ) */
	protected $aHaving;
	protected $aSort; /* Array ( type => (string) , key => (string) ) */
	protected $sLimit; /* String */
	protected $CustomQuery;

	protected $oDb;//DB connection 정보 

	public $insert_id;//생성 요청시 last_insert_id값 
	public $last_query;//
	public $affected_rows;//수정& 삭제시 영향 받은 행 호출
	
	public function __construct($sTable= "",$sDb="default",$bMulti = false)
	{	
		if($bMulti) {
			if(self::$aConn[$sDb]){
				$this->oDb = self::$aConn[$sDb];
			}else {
				self::$aConn[$sDb] = \Config\Database::connect($sDb,false);
				$this->oDb = self::$aConn[$sDb];
			}
		}else {
			self::$aConn[$sDb] = \Config\Database::connect($sDb,false);
			$this->oDb = self::$aConn[$sDb];
		}
		if($sTable){
			$this->sTableName= $sTable;
		}
	}

	public function reconnect($sDb="default") {
		$this->oDb->reconnect();
	}

	public function setTable($sTable = ""){
		$this->sTableName = $sTable;
		return $this;
	}

	/* common method */
	public function setSelect($select = '*'){
		$this->aSelect = $select;
		return $this;
	}

	public function setWhere($where = Array()){
		$this->aWhere = $where;
		return $this;
	}

	public function setJoin($join = Array()){
		$this->aJoin = $join;
		return $this;
	}

	public function setGroup($group = Array()){
		$this->aGroup = $group;
		return $this;
	}

	public function setHaving($aHaving = Array()){
		$this->aHaving = $aHaving;
		return $this;
	}

	public function setLimit($limit = ""){
		$this->sLimit = $limit;
		return $this;
	}

	
	/**
	* @brief 쿼리 행 개수 호출
	* @details 
	* @author rudtmd456
	* @param 
	* @return 쿼리 행 개수
	*/
	public function getRow(){
		if(isset($this->CustomQuery)){
			$sQuery = $this->CustomQuery;
		}else{
			$sQuery = $this->CreateQuery();
		}
		preg_match("/SELECT((.|\n)*)FROM/i",$sQuery,$aMatch); 
		$sQuery =  str_replace($aMatch[1]," count(*) as total ",$sQuery);
		$res = $this->oDb->query($sQuery);
		if($res){
			$aData = $res->getRowArray();
			return $aData["total"];
		}else {

			return false;
		}
		return $aMatch;
	}

	/**
	* @brief 행 하나만 가져오는 경우
	* @details 
	* @author rudtmd456
	* @param 
	* @return 행하나
	*/
	public function GetDataOne($sField = ""){
		if(isset($this->CustomQuery)){
			$sQuery = $this->CustomQuery;
		}else{
			$sQuery = $this->CreateQuery();
		}

		$res = $this->oDb->query($sQuery);
		$this->last_query = $sQuery;
		if($res){
			$aData = $res->getRowArray();
			if($sField){
				$this->Reset();
				return $aData[$sField];
			}else {
				$this->Reset();
				return $aData;
			}
		}else{
			$this->Reset();
			return false;
		}
	}

	/**
	* @brief 행 전체 가져오기
	* @details 
	* @author rudtmd456
	* @param 
	* @return 쿼리한 행 전체
	*/
	public function GetData($getquery = false){
		if($getquery == true){
			return $this->getQuery();
		}
		if(isset($this->CustomQuery)){
			$sQuery = $this->CustomQuery;
		}else{
			$sQuery = $this->CreateQuery();
		}

		$res = $this->oDb->query($sQuery);
		$this->last_query = $sQuery;
			
		if($res){
			$this->Reset();
			return $res->getResultArray();
		}else{
			$this->Reset();
			return false;
		}
	}
	
	/**
	* @brief 쿼리 직접 입력
	* @details 
	* @author rudtmd456
	* @param $sQuery => 입력할 쿼리
	* @return 자기자신
	*/
	public function CustomQuery($sQuery){
		$this->CustomQuery = $sQuery;
		return $this;
	}

	/**
	* @brief 입력한 값의 쿼리 결과 호출
	* @details 
	* @author rudtmd456
	* @param 
	* @return 현재 쿼리 결과 호출
	*/
	public function getQuery(){
		if(isset($this->CustomQuery)){
			return $this->CustomQuery;
		}else{
			return $this->CreateQuery();
		}
	}

	/**
	* @brief 현재 쿼리 결과 호출
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	private function CreateQuery(){
		$sQuery = "SELECT ";
		$sQuery .= $this->getSelect();
		$sQuery .= "FROM ";
		$sQuery .= $this->getTable()." ";
		$sQuery .= $this->getJoin();
		$sQuery .= $this->getWhere();
		$sQuery .= $this->getGroup();
		$sQuery .= $this->getHaving();
		$sQuery .= $this->getSort();
		$sQuery .= $this->getLimit();

		return $sQuery;
	}

	/**
	* @brief select 할 값  요청
	* @details 
	* @author rudtmd456
	* @param 
	* @return 쿼리
	*/
	public function Select($aSelect){
		if(is_string($aSelect)){
			$this->aSelect = $aSelect." ";
		}else if(is_array($aSelect)){
			$this->aSelect = $aSelect;
		}else{
			return false;
		}
		return $this;
	}

	/**
	* @brief 데이터 입력
	* @details 
	* @author rudtmd456
	* @param $aVal => 입력할 값, $bool 압축여부
	* @return 입력 성공 여부
	*/
	public function Insert($aVal,$bool = false){ /* Insert data to table key = value, when bool true return insert Query */
		if($bool){
			return $this->oDb->set($aVal)->getCompiledInsert($this->sTableName);

		}else{
			if($this->oDb->table($this->sTableName)->insert($aVal)){
				$this->insert_id = $this->oDb->insertID();
				$this->last_query = $this->oDb->getLastQuery();
				$this->affected_rows = 1;
				$this->Reset();
				return true;
			}else {
				$this->Reset();
				return false;
			}
		}
	}

	/**
	* @brief 데이터 변경
	* @details 
	* @author rudtmd456
	* @param $aVal=> 변경할 데이터, $sCon=> 변경할 데이터 조건, $bool 압축여부
	* @return 변경 성공 여부
	*/
	public function Update($aVal, $sCon, $bool = false) { /* Update data same param $this->Insert */
		if($bool){
			return $this->oDb->table($this->sTableName)->set($aVal)->where($sCon)->getCompiledUpdate();
		}else{
			if($this->oDb->table($this->sTableName)->update($aVal, $sCon)){
				$this->insert_id = 0;
				$this->last_query = $this->oDb->getLastQuery();
				$this->affected_rows = $this->oDb->affectedRows();
				$this->Reset();
				return true;
			}else {
				$this->Reset();
				return false;
			}
		}
	}
	/**
	* @brief 삭제
	* @details 
	* @author rudtmd456
	* @param 
	* @return 삭제 성공 여부
	*/
	public function Delete($aCon) {
		if(is_array($aCon) && count($aCon) >= 1 ){
			if($this->oDb->table($this->sTableName)->delete($aCon)){
				$this->Reset();
				return true;
			}
		}
		$this->Reset();
		return false;
	}

	/**
	* @brief group by count 계산
	* @details 그룹으로 묶은 행 갯수 계산
	* @author 김경승
	* @param 
	* @return 행 계수
	*/
	public function getDataRow(){
		if(isset($this->CustomQuery)){
			$sQuery = $this->CustomQuery;
		}else{
			$sQuery = $this->CreateQuery();
		}

		$sQuery = "SELECT count(*) as total FROM (".$sQuery.") as temp";
		$res = $this->oDb->query($sQuery);
		if(count($res->getResult()) > 0){
			$aData = $res->getRowArray();
			return $aData["total"];
		}else {
			return false;
		}
	}

	/**
	* @brief join 조건 추가
	* @details 
	* @author rudtmd456
	* @param $aJoin => 전체 조인 조건 or 조인 테이블 , sCon => 조인 조건, type => left,right 조건 여부
	* @return 
	*/
	public function Join($aJoin, $sCon = "", $type = "left"){ /* Array (tablename,where,type ) */
		if($aJoin){
			if(is_string($aJoin)){
				$aJoin = Array($aJoin, $sCon, $type);
			}
			$sPattern = "/(.*)(?:\s+)(.*)|(.*)/";
			preg_match($sPattern, $aJoin[0], $match);
			if(isset($match[2]) && $match[2] != ""){
				$tablename = $match[1];
				$alias = $match[2];
			}else{
				$tablename = $match[3];
				$alias = "";
			}

			if(is_array($aJoin[1])){
				$where = implode(" AND ", $aJoin[1]);
			}else{
				$where = $aJoin[1];
			}

			$this->aJoin[] = Array(
				'tablename' => $tablename,
				'where' => $where,
				'alias' => $alias,
				'type' => $aJoin[2]
			);

			return $this;
			
		}else{
			return false;
		}
	}
	
	/**
	* @brief where 조건 추가
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	public function Where($sWhere){ /* string of where */
		if($sWhere != ""){
			$this->aWhere[] = $sWhere;
		}

		return $this;
	}

	/**
	* @brief group by 조건 추가
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	public function Group($sGroup){
		$this->aGroup[] = $sGroup;
		return $this;
	}
	
	/**
	* @brief having 조건 추가
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	public function Having($sHaving){
		if(is_array($sHaving)) {
			foreach($sHaving as $nHaving) {
				$this->aHaving[] = $nHaving;
			}
		}else {
			$this->aHaving[] = $sHaving;
		}
		return $this;
	}
	
	/**
	* @brief 정렬 조건 추가
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	public function Sort($sSort,$sType = "asc"){
		if($sSort != ""){
			$this->aSort[] = Array("type"=> trim($sType),"key"=> trim($sSort));
		}
		return $this;
	}

	/**
	* @brief limit 조건 추가
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	public function Limit($sLimit){
		$this->sLimit = $sLimit;
		return $this;
	}
	
	/**
	* @brief 쿼리 조건 초기화
	* @details 여태까지 쿼리 검색 조건들 초기화
	* @author rudtmd456
	* @param 
	* @return
	*/
	public function Reset(){
		$this->aSelect = "*";
		$this->aWhere = null;
		$this->aJoin = null;
		$this->aGroup = null;
		$this->aHaving = null;
		$this->aSort = null; 
		$this->sLimit = null;
		$this->CustomQuery = null;

	}
	/**
	* @brief select 필드 호출
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	protected function getSelect(){
		if($this->aSelect === "*" || $this->aSelect === ""){
			$aSelect = "* ";
		}else{
			if(is_array($this->aSelect)){
				$aSelect = implode(",", $this->aSelect)." ";
			}else{
				$aSelect = $this->aSelect." ";
			}
		}
		
		return $aSelect;
	}

	/**
	* @brief join 조건 목록 호출
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	protected function getJoin(){
		$aJoin = " ";
		if(is_array($this->aJoin)){
			foreach($this->aJoin as $val){
				if(isset($val['type'])){
					$aJoin .= $val['type']." JOIN ";
				}else{
					$aJoin .= "LEFT JOIN ";
				}
				$aJoin .= $val['tablename']." ";
				if(isset($val['alias']) && $val['alias'] != ""){
					$aJoin .= "AS ".$val['alias']." ";
				}
				$aJoin .= "ON ";
				if(isset($val['where'])){
					if(is_array($val['where'])){
						$aJoin .= "(".implode(" AND ", $val['where']).") ";
					}else{
						$aJoin .= "(".$val['where'].") ";
					}
				}
			}
		}

		return $aJoin;
	}

	/**
	* @brief where 조건 목록 호출
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	protected function getWhere(){
		$aWhere = " ";
		if(is_array($this->aWhere)){
			$aWhere = "WHERE ".implode(" AND ", $this->aWhere)." ";
		}

		return $aWhere;
	}

	/**
	* @brief group by 조건 목록 호출
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	protected function getGroup(){
		if($this->aGroup){
			$aGroup = "GROUP BY ";
			if(is_array($this->aGroup)){
				$aGroup .= implode(",", $this->aGroup)." ";
			}else{
				$aGroup .= $this->aGroup." ";
			}
		}else{
			$aGroup = " ";
		}

		return $aGroup;
	}
	
	/**
	* @brief having 조건 추가
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	protected function getHaving(){
		if($this->aHaving){
			$aHaving = "HAVING ";
			if(is_array($this->aHaving)){
				$aHaving .= implode(" AND ", $this->aHaving)." ";
			}else{
				$aHaving .= $this->aHaving." ";
			}
		}else{
			$aHaving = " ";
		}

		return $aHaving;
	}

	/**
	* @brief sort 조건 목록 확인
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	protected function getSort(){
		if(is_array($this->aSort)){
			$aSort = "ORDER BY ";
			foreach($this->aSort as $val){
				
				$sSort = $val['key']." ";

				if(isset($val['type'])){
					$sSort .= $val['type']." ";
				}else{
					$sSort .= "ASC ";
				}

				$tmp[] = $sSort;
			}
			$aSort .= implode(",",$tmp);
			return $aSort;
		}
		return "";//정렬 조건 없는 경우 빈값 반환
	}

	/**
	* @brief limit 조건 호출
	* @details 
	* @author rudtmd456
	* @param 
	* @return
	*/
	protected function getLimit(){
		if($this->sLimit){
			$sLimit = "LIMIT ".$this->sLimit;
		}else{
			$sLimit = "";
		}

		return $sLimit;
	}

	/**
	* @brief 테이블 명 호출 
	* @details 테이블 명 호출 및 alias 추가
	* @author rudtmd456
	* @param 
	* @return
	*/
	protected function getTable(){
		/* set table alias from tablename */
		$tmparr = explode("_", $this->sTableName);
		$tbname = "";
		foreach($tmparr as $val){
			$tbname .= substr($val,0,1);
		}

		return $this->sTableName." AS `".$tbname."`";
	}
	public function getDb(){
		return $this->oDb;
	}
	/**
	* @brief 트랜잭션 시작
	* @details 트랜잭션 시작
	* @author 김경승
	* @param 
	* @return 
	*/
	public function trans_start(){
		$this->trans_begin();
	}
	
	/**
	* @brief 트랜잭션 수동 시작
	* @details 트랜잭션 수동 시작
	* @author 김경승
	* @param 
	* @return 
	*/
	public function trans_begin(){
		$this->oDb->transBegin();
	}

	/**
	* @brief 트랜잭션 롤백
	* @details 트랜잭션 롤백
	* @author 김경승
	* @param 
	* @return 
	*/
	public function trans_rollback(){
		$this->oDb->transRollback();
	}

	/**
	* @brief 트랜잭션 커밋
	* @details 트랜잭션 커밋
	* @author 김경승
	* @param 
	* @return 
	*/
	public function trans_commit(){
		$this->oDb->transCommit();
	}
}
?>
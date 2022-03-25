<?php 
 
	$koneksi = mysqli_connect("localhost","root","","regio_personnel_2");
	 
	// Check connection
	if (mysqli_connect_errno()){
		echo "Koneksi database gagal : " . mysqli_connect_error();
	}
	
 

		$date = date('Y-m-d');
		$new = date('Y-m-d', strtotime($date. ' -1 days'));
		// echo $new;
		// $mysql = "SELECT `name` AS `ID`,
		// 			nik AS `f01`,
		// 			DATE_FORMAT(MIN(scan_time),'%Y') AS `f02`,
		// 			DATE_FORMAT(MIN(scan_time),'%m') AS `f03`,
		// 			DATE_FORMAT(MIN(scan_time),'%d') AS `f04`,
		// 			DATE_FORMAT(MIN(scan_time),'%H') AS `f05`,
		// 			DATE_FORMAT(MIN(scan_time),'%i') AS `f06`,
		// 			NULL AS `f07`,
		// 			NULL AS `f08`,
		// 			NULL AS `f09`,
		// 			SUBSTRING(sn, -4) AS `f10`,
		// 			NULL AS `crtdt`,
		// 			NULL AS `flag`  FROM sys_data_scan
		// 			LEFT JOIN sys_users ON sys_data_scan.`user_id` = sys_users.`id` 
		// 			WHERE scan_time BETWEEN '".$new." 10:00:00' AND '".$new." 23:59:59' AND io = '1' AND sys_users.`role_id` = '6'
		// 			GROUP BY user_id ORDER BY sys_data_scan.`id` ASC";
		$mysql = "SELECT u.nama AS ID, 
					u.nik AS f01, 
					DATE_FORMAT(MIN(a.scan_date), '%Y') AS f02, 
					DATE_FORMAT(MIN(a.scan_date), '%m') AS f03,
					DATE_FORMAT(MIN(a.scan_date), '%d') AS f04,
					DATE_FORMAT(MIN(a.scan_date), '%H') AS f05,
					DATE_FORMAT(MIN(a.scan_date), '%i') AS f06,
					NULL AS f07,
					NULL AS f08,
					NULL AS f09,
					SUBSTRING(a.sn, -4) AS f10,
					NULL AS crtdt,
					NULL AS flag FROM sys_users u 
					LEFT JOIN att_log a ON u.nik = a.pin
					LEFT JOIN sys_gates g ON g.sn = a.sn
					WHERE a.scan_date BETWEEN '".$new." 10:00:00' AND '".$new." 23:59:59' AND g.io = '1' AND u.role_id = '6'
					GROUP BY a.pin";
		$data = $koneksi->query($mysql);
		$rows = [];
		while($row = $data->fetch_row()) {
		    $rows[] = $row;
		}

        $sql = "";
		$column = array();
		$value = array();

		$serverName = "10.126.26.151\SQLEXPRESS"; 
		$connectionInfo = array( "Database"=>"HITFPTA", "UID"=>"App.Regio", "PWD"=>"Regio@ind0f00d");
		$conn = sqlsrv_connect( $serverName, $connectionInfo);

		if( $conn ) 
		{

			if (count($rows) > 0)
			{
			        
			        $sql = "INSERT INTO AtLogRegio (ID,f01,f02,f03,f04,f05,f06,f07,f08,f09,f10,crtdt,flag) VALUES ";
			        for ($i = 0; $i < count($rows); $i++)
			        {
			                $value = [];
			                foreach ($rows[$i] as $col => $val)
			                {
			                        $value[] = $val;
			                }

			                if (strlen($value[1]) < 8) 
			                {
			                	$x = 0;
			                	$y = $x .= $value[1];
			                	$value[1] = $y;
			                	// print_r($value);
			                }
			                		
			                $sql .= "('".implode("','",$value)."'";

			                if ($i < count($rows) -1)
			                {
			                        $sql .= "), ";
			                }
			                else
			                {
			                        $sql .= ")";
			                }
			        }
			}
			// print_r($sql);
			$statement = sqlsrv_query($conn, $sql);
			if($statement === false) {
			    $error = sqlsrv_errors();
			    $error['sql'] = $sql;
			   // echo $error;
			    throw new Exception(json_encode($error));
			} else if($statement) {
			    while($next_result = sqlsrv_next_result($statement)){
			        #echo date("Y-m-d H:i:s",time()). " Reading buffer...\n";
			    }
			}
		}else{
		     echo "Connection could not be established.<br />";
		     // die( print_r( sqlsrv_errors(), true));
		}

		// Close the connection.
		sqlsrv_close( $conn );
 
		
?>
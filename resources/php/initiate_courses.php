<?php
/*******************This part is to set up the database and the tables****************/
$_connection = mysqli_connect(config::$db_host,config::$db_user,config::$db_password);
	$db_name = str_replace(array(' ',','),'_',config::$department);
	mysqli_select_db($_connection,config::$department);
if($_connection){
	$_create_db = mysqli_query($_connection,"CREATE DATABASE IF NOT EXISTS ".$db_name." DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci");
	
	if($_create_db){
		
	mysqli_select_db($_connection,$db_name);
	
	$_create_courses_table = mysqli_query($_connection,"CREATE TABLE `courses`
						   (`course_code` char(20) NOT NULL,
						  `course_title` char(255) NOT NULL,
						  `course_unit` int(1) NOT NULL,
						  `level` int(3) NOT NULL,
						  `course_scope` varchar(1000) NOT NULL,
						  `lecturer_in_charge` char(255) NOT NULL)
						ENGINE=InnoDB DEFAULT CHARSET=latin1;");
						
	
	$_add_course_primary_key = mysqli_query($_connection,"ALTER TABLE `courses` ADD PRIMARY KEY (`course_code`)");
		

	
	$_create_lecturer_table = mysqli_query($_connection,"CREATE TABLE `lecturer` 
							(`id` int(50) NOT NULL,
							  `title` char(10) NOT NULL,
							  `last_name` char(255) NOT NULL,
							  `initial` char(5) NOT NULL,
							  `specialization` char(255) NOT NULL)
							  ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Lecturer''s entity'");
	
	$_add_lecturer_primary_key = mysqli_query($_connection,"ALTER TABLE `lecturer` ADD PRIMARY KEY (`id`)");
	
	if(mysqli_num_rows(mysqli_query($_connection,"SELECT id FROM lecturer")) == 0){//if no lecturer record exist yet
//Add all lecturers initially
$lecturers = array(
				array('title' => 'Prof.','last_name' => 'Sodiya', 'initial' => 'A.S', 'specialization' => 'Computer Network Security, Software Engineering, Information System'),
				array('title' => 'Prof.','last_name' => 'Akinwale', 'initial' => 'A.T', 'specialization' => 'Artificial Intelligence, Database Systems and Discrete Computing'),
				array('title' => 'Prof.','last_name' => 'Folorunsho', 'initial' => 'G.N', 'specialization' => 'Intelligent Information Systems, Software Engineering'),
				array('title' => 'Dr.','last_name' => 'Ojesanmi', 'initial' => 'O.A', 'specialization' => 'Network/Mobile Security Technology'),
				array('title' => 'Dr.','last_name' => 'Onashoga', 'initial' => 'S.A.', 'specialization' => 'Computer Security, Data Mining and Algorithms, Health Informatics'),
				array('title' => 'Dr.','last_name' => 'Arogundade', 'initial' => 'O.T', 'specialization' => 'Data Structure, Database System, Artificial Intelligence'),
				array('title' => 'Dr.','last_name' => 'Vincent', 'initial' => 'O.R', 'specialization' => 'System and Computational Intelligence'),
				array('title' => 'Dr.','last_name' => 'Ibharalu', 'initial' => 'F.T', 'specialization' => 'Mobile Agent Technology, Software Engineering'),
				array('title' => 'Mr.','last_name' => 'Abayomi-Alli', 'initial' => '', 'specialization' => 'Biometric Authetication, Information Security'),
				array('title' => 'Mr.','last_name' => 'Aborisade', 'initial' => 'D.O', 'specialization' => 'Cloud Database, Survivability and Digital Forensic'),
				array('title' => 'Mr.','last_name' => 'Salako', 'initial' => 'O.S', 'specialization' => 'Creative Software System'),
				array('title' => 'Mr.','last_name' => 'Olayiwola', 'initial' => 'O.E', 'specialization' => 'Multimedia Networking, Modelling and Simulation')
				);

	$_add_lecturer_stmt = mysqli_prepare($_connection,"INSERT INTO `lecturer` (`id`, `title`, `last_name`, `initial`, `specialization`) VALUES(?,?,?,?,?)");
							mysqli_stmt_bind_param($_add_lecturer_stmt, 'issss', $id,$title,$last_name,$initial,$spec);
		for($l = 0; $l< count($lecturers); $l++){
			$id = time() + rand(1000,9999);
			$title = $lecturers[$l]['title'];
			$last_name = $lecturers[$l]['last_name'];
			$initial = $lecturers[$l]['initial'];
			$spec = $lecturers[$l]['specialization'];
		mysqli_stmt_execute($_add_lecturer_stmt);
		}
	}

	if(mysqli_num_rows(mysqli_query($_connection,"SELECT course_code FROM courses")) == 0){//if no course exist yet	
//Add all courses initially
$courses = array(
		array('code' => 'CSC 101','title' => 'Introduction to Computer Science','unit' => '2','level' => '100','scope' => '','lecturer' => ''),
		array('code' => 'CSC 102','title' => 'Introduction to Algorithm Techniques','unit' => '2','level' => '100','scope' => '','lecturer' => ''),
		
		array('code' => 'CSC 203','title' => 'Computer Programming I','unit' => '3','level' => '200','scope' => '','lecturer' => ''),
		array('code' => 'CSC 205','title' => 'Discrete Computation','unit' => '3','level' => '200','scope' => '','lecturer' => ''),
		array('code' => 'CSC 207','title' => 'Theory of Computation I','unit' => '2','level' => '200','scope' => '','lecturer' => ''),
		array('code' => 'CSC 209','title' => 'Computer Hardware and Digital Logic','unit' => '2','level' => '200','scope' => '','lecturer' => ''),
		array('code' => 'CSC 251','title' => 'Numerical Computation I','unit' => '2','level' => '200','scope' => '','lecturer' => ''),
		array('code' => 'CSC 201','title' => 'Introduction to Computer Science (for Sciences, Engineering and Non-Agric. Major)','unit' => '3','level' => '200','scope' => '','lecturer' => ''),
		array('code' => 'CSC 211','title' => 'Computer Science for Agricultural Students (for B.Agric Students)','unit' => '2','level' => '200','scope' => '','lecturer' => ''),
		array('code' => 'CSC 202','title' => 'System Analysis and Design','unit' => '2','level' => '200','scope' => '','lecturer' => ''),
		array('code' => 'CSC 204','title' => 'Computer Programming II','unit' => '2','level' => '200','scope' => '','lecturer' => ''),
		array('code' => 'CSC 206','title' => 'Data Structure and Algorithms','unit' => '2','level' => '200','scope' => '','lecturer' => ''),
		array('code' => 'CSC 208','title' => 'Foundations of Sequential Programming','unit' => '2','level' => '200','scope' => '','lecturer' => ''),
		array('code' => 'CSC 212','title' => 'Operating System I','unit' => '2','level' => '200','scope' => '','lecturer' => ''),
		array('code' => 'CSC 216','title' => 'Computer Architecture and Organization','unit' => '2','level' => '200','scope' => '','lecturer' => ''),
		
		array('code' => 'CSC 301','title' => 'Structured Programming','unit' => '2','level' => '300','scope' => '','lecturer' => ''),
		array('code' => 'CSC 303','title' => 'Object-Oriented Programming','unit' => '3','level' => '300','scope' => '','lecturer' => ''),
		array('code' => 'CSC 305','title' => 'Algorithms and Complexity Analysis','unit' => '3','level' => '300','scope' => '','lecturer' => ''),
		array('code' => 'CSC 307','title' => 'Operating System II','unit' => '3','level' => '300','scope' => '','lecturer' => ''),
		array('code' => 'CSC 311','title' => 'Information Technology Management','unit' => '2','level' => '300','scope' => '','lecturer' => ''),
		array('code' => 'CSC 313','title' => 'Software Engineering I','unit' => '3','level' => '300','scope' => '','lecturer' => ''),
		array('code' => 'CSC 315','title' => 'Database Systems I','unit' => '3','level' => '300','scope' => '','lecturer' => ''),
		array('code' => 'CSC 351','title' => 'Numeric Computation II','unit' => '2','level' => '300','scope' => '','lecturer' => ''),
		array('code' => 'CSC 392','title' => 'Industrial Traing/Field Work','unit' => '4','level' => '300','scope' => '','lecturer' => ''),
		array('code' => 'CSC 394','title' => 'Inspection/Visitation','unit' => '2','level' => '300','scope' => '','lecturer' => ''),
		array('code' => 'CSC 396','title' => 'SIWES Report','unit' => '4','level' => '300','scope' => '','lecturer' => ''),
		array('code' => 'CSC 398','title' => 'Seminar','unit' => '4','level' => '300','scope' => '','lecturer' => ''),
	
		array('code' => 'CSC 401','title' => 'Organization of Programming Language','unit' => '3','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 403','title' => 'Database Systems II','unit' => '3','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 405','title' => 'Software Engineering II','unit' => '2','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 407','title' => 'Operations Research','unit' => '3','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 409','title' => 'Artificial Intelligence','unit' => '3','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 411','title' => 'Computer Networks and Data Communication','unit' => '3','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 421','title' => 'Special Topics in Computer Science','unit' => '2','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 413','title' => 'Human-Computer Interface','unit' => '3','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 415','title' => 'Information and Communication Theory','unit' => '2','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 417','title' => 'Logic Programming','unit' => '2','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 402','title' => 'Network Programming','unit' => '3','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 404','title' => 'Distributed Computing Systems','unit' => '3','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 406','title' => 'Computer Security and Cryptography','unit' => '2','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 408','title' => 'Computer System Performance Evaluation','unit' => '2','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 414','title' => 'Net-Centric and Web Programming','unit' => '2','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 420','title' => 'Technopreneurship','unit' => '2','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 422','title' => 'Information Technology Law and Ethics','unit' => '1','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 412','title' => 'Modelling and Simulation','unit' => '3','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 416','title' => 'Computer Graphics and Visualization','unit' => '2','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 418','title' => 'Statistical Computing and Data Mining','unit' => '2','level' => '400','scope' => '','lecturer' => ''),
		array('code' => 'CSC 499','title' => 'Project','unit' => '6','level' => '400','scope' => '','lecturer' => ''),

		);
		
	$_add_course_stmt = mysqli_prepare($_connection,"INSERT INTO `courses` (`course_code`, `course_title`, `course_unit`, `level`, `course_scope`, `lecturer_in_charge`) VALUES(?,?,?,?,?,?)");
					mysqli_stmt_bind_param($_add_course_stmt, 'ssiiss', $code,$title,$unit,$level,$scope,$lecturer);
		
		for($c = 0; $c< count($courses); $c++){
			$code = $courses[$c]['code'];
			$title = $courses[$c]['title'];
			$unit = $courses[$c]['unit'];
			$level = $courses[$c]['level'];
			$scope = $courses[$c]['scope'];
			$lecturer = $courses[$c]['lecturer'];
		mysqli_stmt_execute($_add_course_stmt);
		}		
	}	
		
		}
		mysqli_close($_connection);
}
else{
	echo "<h2 class=\"text-center\">Something went wrong</h2>";
}
/*******************************************************************************************/

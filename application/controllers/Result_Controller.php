<?php


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Result_Controller extends CI_Controller
{

	/*	public function my_DOMPDF(){

			  $this->load->library('pdf');
			  $this->pdf->load_view('common/template');
			  $this->pdf->render();
			  $this->pdf->stream("welcome.pdf");
			 } */


	public function __construct()
	{
		parent::__construct();
		//$this->load->library('excel');
		$this->load->library('Pdf');
	}


	#Show the index page.
	public function index()
	{
		$data['all_session'] = $this->Result_Model->get_all_session();
		$data['all_subject'] = $this->Result_Model->get_all_subject();
		$data['all_student'] = $this->Result_Model->get_num_of_rows_student();
		$this->load->view('result/index', $data);
		//$this->load->view('result/header',$data);
	}

	#Show syllabus info.
	public function syllabus()
	{
		$data['all_session'] = $this->Result_Model->get_all_session();
		$data['all_subject'] = $this->Result_Model->get_all_subject();
		$data['values'] = $this->Result_Model->get_syllabus();
		$this->load->view('result/syllabus', $data);
	}

	public function syllabus_condition_faculty_controller()
	{

		$data['all_session'] = $this->Result_Model->get_all_session();
		$data['all_subject'] = $this->Result_Model->get_all_subject();

		$this->load->view('result/syllabus_condition_faculties', $data);
	}

	public function show_syllabus_controller()
	{
		$faculty = $this->input->post('faculty');
		$profile = $this->input->post('profile');

		$data['all_session'] = $this->Result_Model->get_all_session();
		$data['all_subject'] = $this->Result_Model->get_all_subject();

		$data['level'] = array();
		$data['semester'] = array();
		for ($i = 1; $i <= 4; $i++) {
			$level = $i;
			//echo $level;
			//araay_push($data['level'],$level);
			$data['level'][] = $level;
			$data['semester'][] = 1;
			$data['semester'][] = 2;
			//array_push($data['semester'],'2');
		}

		//echo $data['semester'][7];
		//echo 'hi';

		$data['all_from_syllabus'] = $this->Result_Model->fetch_sem_lev_co_code_title_cre_hr_deg_from_syllabus($faculty, $profile);

		//echo $data['all_from_syllabus'][0]['course_code'];
		$this->load->view('result/show_syllabus', $data);
	}

	public function syllabus_condition_others_controller()
	{
		$faculty = $this->input->post('faculty');
		$data['profile'] = $this->Result_Model->get_profile_from_syllabus($faculty);
		//var_dump($data['profile']);
		$this->load->view('result/syllabus_condition_others');
	}

	public function fetch_profile_for_syllabus()
	{
		$faculty = $_POST['faculty'];
		$profile = $this->Result_Model->get_profile_from_syllabus($faculty);
		echo $profile;
	}

	#Show student list but without session search condition.
	public function student()
	{
		error_reporting(0);
		$student['all_session'] = $this->Result_Model->get_all_session();
		$student['all_subject'] = $this->Result_Model->get_all_subject();
		$student['values'] = $this->Result_Model->get_all_from_student();
		$student['session_search'] = $_POST['session_val'];
		$student['subject_search'] = $_POST['subject_val'];
		$this->load->view('result/student_info', $student);
	}

	public function modified_id_list()
	{
		$id = $_POST['id'];
		$data['all_session'] = $this->Result_Model->get_all_session();
		$data['all_subject'] = $this->Result_Model->get_all_subject();
		$data['values'] = $this->Result_Model->get_searched_id($id);
		//echo $data->registration;
		$this->load->view('result/student_info', $data);
	}

	public function modified_name_list()
	{
		$name = $_POST['name'];
		$data['all_session'] = $this->Result_Model->get_all_session();
		$data['all_subject'] = $this->Result_Model->get_all_subject();
		$data['values'] = $this->Result_Model->get_searched_name($name);
		$this->load->view('result/student_info', $data);
	}

	public function modified_session_list()
	{
		$session = $_POST['session'];
		$data['values'] = $this->Result_Model->get_session($session);
		$data['all_session'] = $this->Result_Model->get_all_session();
		$data['all_subject'] = $this->Result_Model->get_all_subject();
		$this->load->view('result/student_info', $data);
	}

	public function modified_subject_list()
	{
		$subject = $_POST['subject'];
		$data['all_session'] = $this->Result_Model->get_all_session();
		$data['all_subject'] = $this->Result_Model->get_all_subject();
		$data['values'] = $this->Result_Model->get_subject($subject);
		$this->load->view('result/student_info', $data);
	}



	#Show student list based on session search result.
	public function student_insert()
	{
		$this->Result_Model->insert_student();
		$student['values'] = $this->Result_Model->get_student();
		$this->load->view('result/student_info', $student);
	}

	#Insert marks to students based on conditions.
	public function marks()
	{
		error_reporting(0);
		$data['all_session'] = $this->Result_Model->get_all_session();
		$data['all_subject'] = $this->Result_Model->get_all_subject();
		$this->load->view('result/mark_info', $data);
	}

	#Currently unused.
	public function entry_mark()
	{
		$mark['values'] = $this->Result_Model->mark_entry();
		$this->load->view('result/mark_entry', $mark);
	}

	#Currently unused.
	public function pre_syllabus()
	{
		$profile = $_POST['profile'];
		print_r($profile);
	}

	#Assign profile to a group of students according to subject & session.
	public function assign_syllabus()
	{
		$this->load->model('Result_Model');
		$data['all_session'] = $this->Result_Model->get_all_session();
		$data['all_subject'] = $this->Result_Model->get_all_subject();
		$data['values'] = $this->Result_Model->assign_test_syllabus();

		$this->load->view('result/assign_syllabus', $data);
	}

	#Currently unused.
	public function get_syllabus()
	{

		$subject = 	$this->input->post('subjects');
		$session = $this->input->post('session');
		$degree = $this->input->post('degree');
		$syllabus = $this->input->post('syllabus');
		$this->load->model('Result_Model');
		print_r($subject);
	}

	#Show the page where the marks will be given against id.
	public function get_courses()
	{

		$session = $this->input->post('session');
		$subject = $this->input->post('subject');
		$semester = $this->input->post('semester');
		$course_code = $this->input->post('course_code');

		/*	echo $session;
				echo $subject;
				echo $semester;
				echo $course_code; */

		$data['all_session'] = $this->Result_Model->get_all_session();
		$data['all_subject'] = $this->Result_Model->get_all_subject();

		$data['active_session'] = $this->Result_Model->get_the_active_session($session, $subject);
		$active_session = $data['active_session'][0]['active_session'];


		//	$active_session = $data['active_session'][0]['active_session'];

		$rem = $semester % 2;
		$div = floor($semester / 2);
		if ($semester % 2 == 0) $semester = 2;
		else if ($semester % 2 == 1) $semester = 1;
		$level = $rem + $div;

		$data['idsss'] = $this->Result_Model->get_idsss($active_session, $subject);
		//	$u = $data['idsss'];

		$data['mark'] = array();
		$data['repeat_course'] = array();
		for ($j = 0; $j < count($data['idsss']); $j++) {
			$main_id = $data['idsss'][$j]['id'];
			$temp_repeat_course = $this->Result_Model->get_the_repeat_course($main_id, $level, $semester, $course_code);
			//echo $temp_repeat_course['repeat_course']; echo "  ";
			$the_mark = $this->Result_Model->get_the_mark($main_id, $level, $semester, $course_code);
			//	echo $the_mark['marks']; echo ' ';
			if (isset($the_mark)) {
				array_push($data['mark'], $the_mark);
			}
			if ((isset($temp_repeat_course))) {
				array_push($data['repeat_course'], $temp_repeat_course);
			}
		}

		$data['total_elements'] = count($data['mark']);
		//$data['total_students'] = count($data['mark']);
		//echo count($data['idsss']);
		// $data['mark'][1]['marks'];
		//$at['neww'] = array_merge($data['idsss'],$data['mark']);

		//	$main_id = 1502039;
		//$data['mark'] = $this->Result_Model->get_the_mark($main_id,$level,$semester,$course_code);

		if (isset($subject)) {

			$data['profile'] = $this->Result_Model->fetch_profile_for_insert_marks_model($subject, $session);

			$data['id'] = $this->Result_Model->fetch_id_subject_session_for_insert_mark_model($subject, $session, $active_session);
			$data['co_code_sem_lev'] = $this->Result_Model->fetch_sem_model($subject, $semester, $course_code, $level);


			$data['total_students']	= count($data['id']);



			$this->load->view('result/insert_marks', $data);
		}
	}

	public function set_courses()
	{
		$this->load->view('result/insert_marks');
	}

	#Show the page of mark insertion.
	public function mark_insert()
	{
		$course_code = $this->input->post('course_code');
		$level = $this->input->post('level[0]');
		$semester = $this->input->post('semester[0]');
		$session = $this->input->post('session[0]');

		$data['id_session'] = $this->Result_Model->get_id_session($session);
		$data['co_code_cre_hr'] = $this->Result_Model->insert_code($course_code);
		$data['lev_sem'] = $this->Result_Model->insert_level($level, $semester);
		$this->load->view('result/insert_marks', $data);
	}

	public function get_mark()
	{
		error_reporting(0);
		$button = $_POST['req_id'];

		if ($button == "submit_button") {

			$req_check = $_POST['req_check'];
			$mark = $_POST['mark_for_update'];
			$course_code = $_POST['co_code'];
			$level = $_POST['level'];
			$semester = $_POST['semester'];
			$credit_hour = $_POST['credit_hour'];
			$id = $_POST['id_for_update'];
			$check = $_POST['check'];
			$repeat = 0;
			for ($i = 0; $i < count($id); $i++) {
				if ($mark[$i] >= 0 && $mark[$i] < 40) {
					$grade = "F";
					$gpa = 0.00;
					$credit = 0;
				} else {
					if ($mark[$i] >= 40 && $mark[$i] < 45) {
						$grade = "D";
						$gpa = 2.00;
					}
					if ($mark[$i] >= 45 && $mark[$i] < 50) {
						$grade = "C";
						$gpa = 2.25;
					}
					if ($mark[$i] >= 50 && $mark[$i] < 55) {
						$grade = "C+";
						$gpa = 2.50;
					}
					if ($mark[$i] >= 55 && $mark[$i] < 60) {
						$grade = "B-";
						$gpa = 2.75;
					}
					if ($mark[$i] >= 60 && $mark[$i] < 65) {
						$grade = "B";
						$gpa = 3.00;
					}
					if ($mark[$i] >= 65 && $mark[$i] < 70) {
						$grade = "B+";
						$gpa = 3.25;
					}
					if ($mark[$i] >= 70 && $mark[$i] < 75) {
						$grade = "A-";
						$gpa = 3.50;
					}
					if ($mark[$i] >= 75 && $mark[$i] < 80) {
						$grade = "A";
						$gpa = 3.75;
					}
					if ($mark[$i] >= 80 && $mark[$i] <= 100) {
						$grade = "A+";
						$gpa = 4.00;
					}
				}

				if ($check[$repeat] == $id[$i]) {
					$repeat_course = 1;
					$repeat++;
				} else {
					$repeat_course = 0;
				}


				//Calculate GPA...

				$gpa_ccode_for_gpa['value'] = $this->Result_Model->fetch_gpa_cc_from_marks_table_for_gpa($id[$i], $level, $semester);

				$num_of_rows_for_gpa = $this->Result_Model->get_num_of_rows_marks_table_for_gpa($id[$i], $level, $semester);

				$gpa_multi_cch_for_gpa = 0;
				$total_credit_hr_for_gpa = 0;

				for ($j = 0; $j < $num_of_rows_for_gpa; $j++) {

					$c_code_for_gpa =  $gpa_ccode_for_gpa['value'][$j]['course_code'];

					$get_cch['value'] = $this->Result_Model->fetch_cch_from_syllabus_table($c_code_for_gpa);
					if ($gpa_ccode_for_gpa['value'][$j]['grade_point'] > 0)
						$total_credit_hr_for_gpa += $get_cch['value'][0]['credit_hour'];

					$gpa_multi_cch_for_gpa += ($get_cch['value'][0]['credit_hour'] * $gpa_ccode_for_gpa['value'][$j]['grade_point']);
				}

				$gpa_multi_cch_for_gpa += ($gpa * $credit_hour);
				//if($i == 0) echo $gpa_multi_cch_for_gpa;
				if ($gpa > 0) {
					$total_credit_hr_for_gpa += $credit_hour;
				}

				if ($total_credit_hr_for_gpa == 0) $avg_gpa_for_gpa = 0;

				else
					$avg_gpa_for_gpa = $gpa_multi_cch_for_gpa / $total_credit_hr_for_gpa;

				//	echo $avg_gpa_for_gpa;

				$num_of_rows_in_marks_table = $this->Result_Model->check_id_lev_sem_co_code_exist_in_marks($id[$i], $level, $semester, $course_code);
				$num_of_rows_for_prev_sem_in_marks_table = 0;
				//	$new_level = $level - 1;
				if ($semester % 2 == 0) {
					$new_semester = 1;
					$new_level = $level;
				} else if ($semester % 2 == 1) {
					$new_semester = 2;
					$new_level = $level - 1;
				}

				//	if($new_semester == 1 && $level == 1) {$new_level = 1;}

				$num_of_rows_for_prev_sem_in_marks_table = $this->Result_Model->check_prev_sem_data_exist($id[$i], $new_level, $new_semester);

				if ($level == 1 && $semester == 1) {
					$num_of_rows_for_prev_sem_in_marks_table = 1;
				}

				if ($num_of_rows_in_marks_table == 0 && $num_of_rows_for_prev_sem_in_marks_table > 0) {
					$this->Result_Model->insert_data_into_marks_table($level, $semester, $course_code, $id[$i], $mark[$i], $grade, $gpa, $check[$i]);
				}

				$num_of_rows_in_result_table = $this->Result_Model->check_id_lev_sem_exist($id[$i], $level, $semester);
				$avg_gpa_for_gpa = round($avg_gpa_for_gpa, 3);

				if ($num_of_rows_in_result_table != 0) {
					$this->Result_Model->update_cch_gpa_in_result_table($id[$i], $level, $semester, $avg_gpa_for_gpa);
				} else {
					//Check if previous semester exist or not...
					if ($level != 1) {
						$prev_level = $level - 1;
						if ($semester % 2 == 1) {
							$prev_semester = $semester + 1;
							$num_of_rows = $this->Result_Model->check_lev_sem_exist($prev_level, $prev_semester);
							if ($num_of_rows > 0) {
								$this->Result_Model->insert_id_level_sem_cch_gpa_in_result_table($id[$i], $level, $semester, $avg_gpa_for_gpa);
							} else echo "Can't be done";
						} else if ($semester % 2 == 0) {
							$prev_semester = $semester - 1;
							$num_of_rows = $this->Result_Model->check_lev_sem_exist($level, $prev_semester);
							if ($num_of_rows > 0) {
								$this->Result_Model->insert_id_level_sem_cch_gpa_in_result_table($id[$i], $level, $semester, $avg_gpa_for_gpa);
							} else echo "Can't be done";
						}
					} else if ($level == 1) {
						if ($semester == 2) {
							$prev_semester = $semester - 1;
							$num_of_rows = $this->Result_Model->check_lev_sem_exist($level, $prev_semester);
							if ($num_of_rows > 0) {
								$this->Result_Model->insert_id_level_sem_cch_gpa_in_result_table($id[$i], $level, $semester, $avg_gpa_for_gpa);
							} else echo "Can't be done";
						} else if ($semester == 1) {
							$this->Result_Model->insert_id_level_sem_cch_gpa_in_result_table($id[$i], $level, $semester, $avg_gpa_for_gpa);
						}
					}
				}



				$temp_level = $level;
				$temp_semester = $semester;
				$change_level = $level;
				$change_semester = $semester;
				$update_level = $change_level;


				$k = 1;
				$f = 0;
				$temp = 0;
				$total_credit_hr_for_update = 0;
				$gpa_multi_cch_for_cgpa_update = 0;

				while (1) {
					while (1) {
						$gpa_ccode_for_gpa['value'] = $this->Result_Model->fetch_gpa_cc_from_marks_table_for_gpa($id[$i], $temp_level, $temp_semester);

						$num_of_rows_for_gpa = $this->Result_Model->get_num_of_rows_marks_table_for_gpa($id[$i], $temp_level, $temp_semester);


						for ($j = 0; $j < $num_of_rows_for_gpa; $j++) {

							$c_code_for_gpa =  $gpa_ccode_for_gpa['value'][$j]['course_code'];

							$get_cch['value'] = $this->Result_Model->fetch_cch_from_syllabus_table($c_code_for_gpa);
							if ($gpa_ccode_for_gpa['value'][$j]['grade_point'] > 0)
								$total_credit_hr_for_update += $get_cch['value'][0]['credit_hour'];

							$gpa_multi_cch_for_cgpa_update += ($get_cch['value'][0]['credit_hour'] * $gpa_ccode_for_gpa['value'][$j]['grade_point']);
						}

						if ($f == 1) break;
						if ($temp_level == 1 && $temp_semester == 1) {
							$f = 1;
							break;
						}
						if ($temp_semester == 2) $temp_semester = 1;
						else if ($temp_semester == 1) {
							$temp_semester = 2;
							$temp_level -= 1;
						}
					}
					if ($total_credit_hr_for_update == 0) $cgpa = $gpa_multi_cch_for_cgpa_update / $credit_hour;

					else $cgpa = $gpa_multi_cch_for_cgpa_update / $total_credit_hr_for_update;

					$cgpa = round($cgpa, 3);

					if ($temp == 1) $this->Result_Model->update_cgpa_cch($id[$i], $update_level, $change_semester, $cgpa, $total_credit_hr_for_update);
					else if ($temp == 0) {
						$temp = 1;
						$this->Result_Model->update_cgpa_cch($id[$i], $update_level, $change_semester, $cgpa, $total_credit_hr_for_update);
					}

					if ($change_semester == 1) {
						$temp_semester = 2;
						$temp_level = $update_level;
						$change_semester = 2;
					} else if ($change_semester == 2) {
						$temp_semester = 1;
						$temp_level = $change_level + $k;
						$update_level = $change_level + $k;
						$change_semester = 1;
						$k += 1;
					}

					$num_of_rows = $this->Result_Model->check_id_lev_sem_exist($id[$i], $temp_level, $temp_semester);

					if ($num_of_rows == 0) break;
				}
			}

			echo 'Value added successfully...';
		}


		//for update...
		else {
			echo "Value updated";
			$req_check = $_POST['req_check'];
			$req_id = $_POST['req_id'];
			$mark = $_POST['mark_for_update'];
			$course_code = $_POST['co_code'];
			$level = $_POST['level'];
			$semester = $_POST['semester'];
			$credit_hour = $_POST['credit_hour'];
			$id = $_POST['id_for_update'];
			$check = $_POST['check'];
			$req_mark = $_POST['req_mark'];
			$repeat = 0;

			if ($req_mark >= 0 && $req_mark < 40) {
				$grade = "F";
				$gpa = 0.00;
				$credit = 0;
			} else {
				if ($req_mark >= 40 && $req_mark < 45) {
					$grade = "D";
					$gpa = 2.00;
				}
				if ($req_mark >= 45 && $req_mark < 50) {
					$grade = "C";
					$gpa = 2.25;
				}
				if ($req_mark >= 50 && $req_mark < 55) {
					$grade = "C+";
					$gpa = 2.50;
				}
				if ($req_mark >= 55 && $req_mark < 60) {
					$grade = "B-";
					$gpa = 2.75;
				}
				if ($req_mark >= 60 && $req_mark < 65) {
					$grade = "B";
					$gpa = 3.00;
				}
				if ($req_mark >= 65 && $req_mark < 70) {
					$grade = "B+";
					$gpa = 3.25;
				}
				if ($req_mark >= 70 && $req_mark < 75) {
					$grade = "A-";
					$gpa = 3.50;
				}
				if ($req_mark >= 75 && $req_mark < 80) {
					$grade = "A";
					$gpa = 3.75;
				}
				if ($req_mark >= 80 && $req_mark <= 100) {
					$grade = "A+";
					$gpa = 4.00;
				}
			}

			$this->Result_Model->update_marks($req_id, $req_mark, $course_code, $level, $semester, $gpa, $grade);

			$this->Result_Model->update_repeat_in_marks_table($req_id, $level, $semester, $course_code, $req_check);


			$gpa_ccode_for_gpa['value'] = $this->Result_Model->fetch_gpa_cc_from_marks_table_for_gpa($req_id, $level, $semester);

			$num_of_rows_for_gpa = $this->Result_Model->get_num_of_rows_marks_table_for_gpa($req_id, $level, $semester);

			$gpa_multi_cch_for_gpa = 0;
			$total_credit_hr_for_gpa = 0;

			for ($j = 0; $j < $num_of_rows_for_gpa; $j++) {

				$c_code_for_gpa =  $gpa_ccode_for_gpa['value'][$j]['course_code'];

				$get_cch['value'] = $this->Result_Model->fetch_cch_from_syllabus_table($c_code_for_gpa);
				if ($gpa_ccode_for_gpa['value'][$j]['grade_point'] > 0)
					$total_credit_hr_for_gpa += $get_cch['value'][0]['credit_hour'];

				$gpa_multi_cch_for_gpa += ($get_cch['value'][0]['credit_hour'] * $gpa_ccode_for_gpa['value'][$j]['grade_point']);
			}

			//$gpa_multi_cch_for_gpa += ($gpa * $credit_hour);

			if ($total_credit_hr_for_gpa == 0) $avg_gpa_for_gpa = 0;

			else
				$avg_gpa_for_gpa = $gpa_multi_cch_for_gpa / $total_credit_hr_for_gpa;

			$avg_gpa_for_gpa = round($avg_gpa_for_gpa, 3);

			$this->Result_Model->update_gpa_cch_into_result_table($avg_gpa_for_gpa, $req_id, $level, $semester, $total_credit_hr_for_gpa);

			$temp_level = $level;
			$temp_semester = $semester;
			$change_level = $level;
			$change_semester = $semester;
			$update_level = $change_level;

			$k = 1;
			$f = 0;
			$temp = 0;
			$total_credit_hr_for_update = 0;
			$gpa_multi_cch_for_cgpa_update = 0;

			while (1) {
				while (1) {
					$gpa_ccode_for_gpa['value'] = $this->Result_Model->fetch_gpa_cc_from_marks_table_for_gpa($req_id, $temp_level, $temp_semester);

					$num_of_rows_for_gpa = $this->Result_Model->get_num_of_rows_marks_table_for_gpa($req_id, $temp_level, $temp_semester);


					for ($j = 0; $j < $num_of_rows_for_gpa; $j++) {

						$c_code_for_gpa =  $gpa_ccode_for_gpa['value'][$j]['course_code'];

						$get_cch['value'] = $this->Result_Model->fetch_cch_from_syllabus_table($c_code_for_gpa);
						if ($gpa_ccode_for_gpa['value'][$j]['grade_point'] > 0)
							$total_credit_hr_for_update += $get_cch['value'][0]['credit_hour'];

						$gpa_multi_cch_for_cgpa_update += ($get_cch['value'][0]['credit_hour'] * $gpa_ccode_for_gpa['value'][$j]['grade_point']);
					}

					if ($f == 1) break;
					if ($temp_level == 1 && $temp_semester == 1) {
						$f = 1;
						break;
					}
					if ($temp_semester == 2) $temp_semester = 1;
					else if ($temp_semester == 1) {
						$temp_semester = 2;
						$temp_level -= 1;
					}
				}
				if ($total_credit_hr_for_update == 0) $cgpa = $gpa_multi_cch_for_cgpa_update / $credit_hour;

				else $cgpa = $gpa_multi_cch_for_cgpa_update / $total_credit_hr_for_update;

				$cgpa = round($cgpa, 3);

				if ($temp == 1) $this->Result_Model->update_cgpa_cch($req_id, $update_level, $change_semester, $cgpa, $total_credit_hr_for_update);
				else if ($temp == 0) {
					$temp = 1;
					$this->Result_Model->update_cgpa_cch($req_id, $update_level, $change_semester, $cgpa, $total_credit_hr_for_update);
				}

				if ($change_semester == 1) {
					$temp_semester = 2;
					$temp_level = $update_level;
					$change_semester = 2;
				} else if ($change_semester == 2) {
					$temp_semester = 1;
					$temp_level = $change_level + $k;
					$update_level = $change_level + $k;
					$change_semester = 1;
					$k += 1;
				}

				$num_of_rows = $this->Result_Model->check_id_lev_sem_exist($req_id, $temp_level, $temp_semester);

				if ($num_of_rows == 0) break;
			}
		}
	}

	public function pre_total_grade()
	{
		$this->load->view('result/pre_total_grade');
	}

	public function total_grade()
	{
		$data['values'] = $this->Result_Model->get_gpa();
		$this->load->view('result/total_grade');
	}

	#Unused for now.
	public function testing()
	{
		$id = $this->input->post('id');
		$this->Result_Model->test($id);
		$this->load->view('result/testing_view');
	}

	#Load the syllabus info insertion page.
	public function insert_syllabus()
	{
		$this->load->view('result/insert_syllabus');
	}

	#Insert a new course in the syllabus list.
	public function get_to_syllabus()
	{
		$this->Result_Model->insert_syllabus();
		redirect('Result_Controller/syllabus');
	}

	#Delete a course from syllabus info.
	public function delete_course()
	{
		$this->Result_Model->delete_course();
		redirect('Result_Controller/syllabus');
	}

	#Load the student info insertion page.
	public function insert_student_new()
	{
		$this->load->view('result/insert_student');
	}

	#Insert a new student info into student list.
	public function get_student_new()
	{
		$this->Result_Model->get_student_new();
		redirect('Result_Controller/student');
	}

	#Delete a student info from student list.
	public function delete_student()
	{
		$this->Result_Model->delete_student();
		redirect('Result_Controller/student');
	}

	#Unused for now.
	public function search_result()
	{
		$this->load->view('result/search_result');
	}

	#Unused for now.
	public function get_result()
	{
		$this->load->view('result/get_result');
	}

	#Unused for now.
	public function search_condition_for_student_result_controller()
	{
		$this->load->view('result/search_condition_for_student_result');
	}

	public function search_response_for_displaying_result_controller()
	{
		error_reporting(0);
		$id = $this->input->post('id');
		$session = $this->input->post('session');
		$semester = $this->input->post('semester');
		$div = floor($semester / 2);
		$rem = $semester % 2;
		$level = $div + $rem;
		if ($semester % 2 == 0) $sem = 2;
		else $sem = 1;

		$data['get_the_profile'] = $this->Result_Model->get_profile_again($session);
		$temp_profile = $data['get_the_profile'];
		$final_profile = $temp_profile[0]['profile'];

		$data['get_course_code_title_credit'] = $this->Result_Model->get_syllabus_data_for_result($final_profile, $sem, $level);

		$temp_code_title_credit = $data['get_course_code_title_credit'];

		$data['get_gpa'] = $this->Result_Model->get_the_gpa($id, $session, $sem, $level);
		$hey = $data['get_gpa'];
		$hey2 = $hey[0]['gpa'];

		$temp_course_code_2 = $temp_code_title_credit[$i]['course_code'];
		echo $temp_course_code_2;
		$data['get_student_marks'] = $this->Result_Model->get_marks_for_result($id, $level, $sem, $temp_course_code_2);


		$data['get_id_name_reg'] = $this->Result_Model->get_student_info_for_result($id);


		$this->load->view('result/search_response_for_displaying_result', $data);
	}


	#Brief list of the courses inside of a specific profile.
	public function syllabus_view_from_student_table_controller()
	{
		$profile = $_POST['profile'];
		$data['all_data_for_this_profile'] = $this->Result_Model->get_all_from_syllabus($profile);
		$this->load->view('result/syllabus_view_from_student_table', $data);
	}


	#Fetch the session from student table.
	public function fetch_session()
	{

		$subject = $_POST['subject'];

		if ($subject) {
			$s = $this->Result_Model->fetch_session($subject);
			echo $s;
		}
	}

	#Fetch the profile from syllabus table to assign profile later.
	public function fetch_profile()
	{

		$session = $this->input->post('session');
		$subject = $this->input->post('subject');

		if ($this->input->post('subject')) {
			echo  $this->Result_Model->fetch_profile($subject);
		}
	}


	public function fetch_course_code()
	{
		$session = $this->input->post('session');
		$subject = $this->input->post('subject');
		$semester = $this->input->post('semester');

		$rem = $semester % 2;
		$div = floor($semester / 2);
		if ($semester % 2 == 0) $semester = 2;
		else if ($semester % 2 == 1) $semester = 1;
		$level = $rem + $div;

		if ($this->input->post('session')) {

			$profile = $this->Result_Model->fetch_profile_for_course_code_model($subject, $session);
			//echo $profile;
			$result = $this->Result_Model->fetch_course_code_model($subject, $profile, $semester, $level);
			echo $result;
		}
	}

	#Assign profile to a group of students based on session & subject.
	public function update_profile()
	{
		$session = $this->input->post('session');
		$subject = $this->input->post('subject');
		$profile = $this->input->post('profile');

		$this->Result_Model->update_profile($subject, $session, $profile);
	}

	public function view_result_controller()
	{
		$data['all_session'] = $this->Result_Model->get_all_session();
		$data['all_subject'] = $this->Result_Model->get_all_subject();
		$this->load->view('result/view_result', $data);
	}

	public function result_list_controller()
	{
		//echo "i love helen";
		$session = $this->input->post('session');
		$subject = $this->input->post('subject');
		$semester = $this->input->post('semester');
		//$course_code = $this->input->post('course_code');

		$data['session'] = $session;
		$data['subject'] = $subject;


		//echo $data['subject'];

		if ($semester % 2 == 0) {
			$level = $semester / 2;
			$semester = 2;
		} else {

			$level = ceil($semester / 2);
			$semester = 1;
		}
		$data['level'] = $level;
		$data['semester'] = $semester;

		$data['active_session'] = $this->Result_Model->get_the_active_session($session, $subject);
		$active_session = $data['active_session'][0]['active_session'];

		$data['name'] = $this->Result_Model->get_names($active_session, $subject);

		$data['reg'] = $this->Result_Model->get_registrations($active_session, $subject);

		$data['id'] = $this->Result_Model->get_idsss($active_session, $subject);

		//$profile = $this->Result_Model->get_profile_for_result_sheet($active_session,$subject);
		//$data['course_code_title_hour'] = $this->Result_Model->get_course_code_title_hour($level,$semester,$subject,$profile);
		//echo $data['course_code_title_hour'][0]['course_code'];

		$data['mark_lg_gpa_co_code'] = array();
		$data['course_title_hour'] = array();
		$data['temp_gpa_cgpa_cch'] = array();
		$data['temp_pgpa_pcgpa_pcch'] = array();
		//	echo count($data['id']);
		for ($i = 0; $i < count($data['id']); $i++) {
			$temp_id = $data['id'][$i]['id'];
			$temp_mark = $this->Result_Model->get_mark_letter_gpa_co_code($temp_id, $level, $semester);

			$data['req_num_of_rows'][$i] = $this->Result_Model->get_num_of_rows_marks_table_for_gpa($temp_id, $level, $semester);

			//var_dump($data['req_num_of_rows'][$i]);
			//echo "  ";

			$temp_gpa_cgpa_cch = $this->Result_Model->get_gpa_cgpa_cch($temp_id, $level, $semester);
			if (isset($temp_gpa_cgpa_cch)) {
				array_push($data['temp_gpa_cgpa_cch'], $temp_gpa_cgpa_cch);
			}


			if ($semester == 1) {
				$prev_level = $level - 1;
				$prev_semester = 2;
			} else {
				$prev_level = $level;
				$prev_semester = 1;
			}
			$temp_pgpa_pcgpa_pcch = $this->Result_Model->get_gpa_cgpa_cch($temp_id, $prev_level, $prev_semester);

			if (isset($temp_pgpa_pcgpa_pcch)) {
				array_push($data['temp_pgpa_pcgpa_pcch'], $temp_pgpa_pcgpa_pcch);
			}
			//echo count($temp_mark); echo "  ";
			$data['temp_mark_size'][$i] = count($temp_mark);
			for ($j = 0; $j < count($temp_mark); $j++) {
				$temp_course_code = $temp_mark[$j]['course_code'];
				$course_title_hour = $this->Result_Model->get_course_title_hour($temp_course_code);

				array_push($data['mark_lg_gpa_co_code'], $temp_mark[$j]);
				if (isset($course_title_hour)) {
					array_push($data['course_title_hour'], $course_title_hour);
				}
			}
			//	$temp_id = $data[$i]['id'];
			$data['total_fail'][$i] = $this->Result_Model->fetch_total_fail_from_marks($temp_id);
		}

		$data['gpa_count'] = count($data['temp_gpa_cgpa_cch']);
		$data['pgpa_count'] = count($data['temp_pgpa_pcgpa_pcch']);

		$data['all_session'] = $this->Result_Model->get_all_session();
		$data['all_subject'] = $this->Result_Model->get_all_subject();

		$data['num_of_rows'] = $this->Result_Model->num_of_rows_for_name($active_session, $subject);

		$this->load->view('result/result_page', $data);
	}

	public function pdfdetails()
	{
		$level = $_POST['level'];
		$semester = $_POST['semester'];
		$name = $_POST['names'];
		$reg = $_POST['regs'];
		$temp_mark_size = $_POST['temp_mark_size'];



		$use_semester = $level * 2;
		if ($semester == 1) {
			$use_semester -= 1;
		}


		$total_count = $_POST['save'];
		for ($r = 0; $r < count($total_count); $r++) {
			$total_fail = 0;
			if ($total_count[$r] != 0) {
				$total_fail = $_POST['total_fail'];
				break;
			}
		}
		$html = '';
		$f = 0;
		$count = 0;


		for ($j = 0; $j < count($name); $j++) {

			if ($temp_mark_size[$j] > 0) {
				$co_code = $_POST['co_codes'];
				$marks = $_POST['marks'];
				$letter_grade = $_POST['lg'];
				$grade_point = $_POST['gp'];
				$credit_hour = $_POST['cre_hr'];
				$course_title = $_POST['co_title'];
				$gpa = $_POST['gpa'];
				$cgpa = $_POST['cgpa'];
				$cch = $_POST['cch'];
				$pgpa = $_POST['pgpa'];
				$pcgpa = $_POST['pcgpa'];
				$pcch = $_POST['pcch'];
			}

			$sl = 1;
			$row = 1;


			$session = $this->Result_Model->get_session_id_for_pdf($reg[$j]);


			$html .= '<table>';
			$html .= '<tr>';
			$html .= '<td width = "20%">';

			$html .= '<table border = "1">';
			$html .= '<tr>';
			$html .= '<th align = "center"><b>Grading System</b></th>';
			$html .= '</tr>';

			$html .= '<tr>';
			$html .= '<th width = "60%" align = "center">Numerical Grade</th>';
			$html .= '<th width = "20%" align = "center">Letter<br>Grade</th>';
			$html .= '<th width = "20%" align = "center">Grade<br>Point</th>';
			$html .= '</tr>';

			$html .= '<tr>';
			$html .= '<td align = "center">80% and above</td>';
			$html .= '<td align = "center">A+</td>';
			$html .= '<td align = "center">4.00</td>';
			$html .= '</tr>';

			$html .= '<tr>';
			$html .= '<td align = "center">75% less than 80%</td>';
			$html .= '<td align = "center">A</td>';
			$html .= '<td align = "center">3.75</td>';
			$html .= '</tr>';

			$html .= '<tr>';
			$html .= '<td align = "center">70% less than 75%</td>';
			$html .= '<td align = "center">A-</td>';
			$html .= '<td align = "center">3.50</td>';
			$html .= '</tr>';

			$html .= '<tr>';
			$html .= '<td align = "center">65% less than 70%</td>';
			$html .= '<td align = "center">B+</td>';
			$html .= '<td align = "center">3.25</td>';
			$html .= '</tr>';

			$html .= '<tr>';
			$html .= '<td align = "center">60% less than 65%</td>';
			$html .= '<td align = "center">B</td>';
			$html .= '<td align = "center">3.00</td>';
			$html .= '</tr>';

			$html .= '</table>';

			$html .= '</td>';


			$html .= '<td width = "60%">';
			$html .= '<div class = "container" align = "center">';
			$html .= '<br>';
			$html .= '<table>';
			$html .= '<tr>';
			$html .= '<th width = "18%" align = "left">';
			//  $html .= '<img src = "C:\xampp\htdocs\CodeIgniter\images\logo_transparent.png" alt = "hello" height = "80" width = "82">';
			$html .= '  <img src = "images/logo_transparent.png" alt = "hello" height = "80" width = "82">';
			// $html .= '';
			$html .= '</th>';
			$html .= '<th width = "80%" align = "left">';
			$html .= '<div><br><br><h2 style="color: #2895E8">PATUAKHALI SCIENCE AND TECHNOLOGY UNIVERSITY</h2><h3 align="center">Dumki, Patuakhali-8602, Bangladesh</h3></div>';
			$html .= '</th>';
			$html .= '</tr>';
			$html .= '</table>';
			// $html .= '<h3>Dumki, Patuakhali-8602, Bangladesh</h3>';
			$html .= '<h1 align="center" style="color: purple">MARKS CERTIFICATE AND ACADEMIC TRANSCRIPT</h1>';
			$html .= '</div>';
			$html .= '</td>';

			$html .= '<td width = "20%">';

			$html .= '<table border = "1">';
			$html .= '<tr>';
			$html .= '<th align = "center"><b>Grading System</b></th>';
			$html .= '</tr>';

			$html .= '<tr>';
			$html .= '<th width = "60%" align = "center">Numerical Grade</th>';
			$html .= '<th width = "20%" align = "center">Letter<br>Grade</th>';
			$html .= '<th width = "20%" align = "center">Grade<br>Point</th>';
			$html .= '</tr>';

			$html .= '<tr>';
			$html .= '<td align = "center">55% less than 60%</td>';
			$html .= '<td align = "center">B-</td>';
			$html .= '<td align = "center">2.75</td>';
			$html .= '</tr>';

			$html .= '<tr>';
			$html .= '<td align = "center">50% less than 55%</td>';
			$html .= '<td align = "center">C+</td>';
			$html .= '<td align = "center">2.50</td>';
			$html .= '</tr>';

			$html .= '<tr>';
			$html .= '<td align = "center">45% less than 50%</td>';
			$html .= '<td align = "center">C</td>';
			$html .= '<td align = "center">2.25</td>';
			$html .= '</tr>';

			$html .= '<tr>';
			$html .= '<td align = "center">40% less than 45%</td>';
			$html .= '<td align = "center">D</td>';
			$html .= '<td align = "center">2.00</td>';
			$html .= '</tr>';

			$html .= '<tr>';
			$html .= '<td align = "center">Less than 40%</td>';
			$html .= '<td align = "center">F</td>';
			$html .= '<td align = "center">0.00</td>';
			$html .= '</tr>';

			$html .= '</table>';

			$html .= '</td>';

			$html .= '</tr>';
			$html .= '</table>';
			$html .= '<div class = "container" align = "center">';
			$html .= '<h2>';
			$html .= $use_semester;
			if ($use_semester == 1) {
				$html .= 'st';
			} else if ($use_semester == 2) {
				$html .= 'nd';
			} else if ($use_semester == 3) {
				$html .= 'rd';
			} else {
				$html .= 'th';
			}
			$html .= ' Semester(Level-' . $level . ' Semester-' . $semester . ') Final Examination of B.Sc. Engg.(CSE)';
			if ($semester == 1) {
				$html .=  ' January-June-2019</h2>';
			} else if ($semester == 2) {
				$html .=  ' July-December-2019</h2>';
			}

			$html .= '</div>';

			$html .= '<table border = "1">';
			$html .= '<thead>';
			$html .= '<tr>';
			$html .= '<td align = "center">Name of the student: ' . $name[$j] . '</td>';
			$html .= '<td align = "center">Reg. No. ' . $reg[$j] . '</td>';
			$html .= '<td align = "center">Session: ' . $session->session . '</td>';
			$html .= '<td align = "center">Exam Roll No. ' . $session->id . '</td>';
			$html .= '</tr>';

			$html .= '<tr>';
			$html .= '<th width = "2%" align = "center">' . $row++ . '</th>
    						<th width = "8%" align = "center">' . $row++ . '</th>
						    <th width = "15%" align = "center">' . $row++ . '</th>
						    <th width = "4%" align = "center">' . $row++ . '</th>
						    <th width = "7%" align = "center">' . $row++ . '</th>
						    <th width = "7%" align = "center">' . $row++ . '</th>
						    <th width = "7%" align = "center">' . $row++ . '</th>
						    <th width = "5%" align = "center">' . $row++ . '</th>
						    <th width = "5%" align = "center">' . $row++ . '</th>
						    <th width = "5%" align = "center">' . $row++ . '</th>
						    <th width = "7%" align = "center">' . $row++ . '</th>
						    <th width = "7%" align = "center">' . $row++ . '</th>
						    <th width = "21%" align = "center">' . $row++ . '</th>';
			$html .= '</tr>';

			$html .= '<tr>
					 		<th width = "2%" align = "center">SL.<br>No.</th>
    						<th width = "8%" align = "center">Course<br>Code</th>
						    <th width = "15%" align = "center">Course Title</th>
						    <th width = "4%" align = "center">Credit<br>Hours</th>
						    <th width = "7%" align = "center">Total<br>Marks</th>
						    <th width = "7%" align = "center">Letter<br>Grade</th>
						    <th width = "7%" align = "center">Grade<br>Point</th>
						    <th width = "5%" align = "center">GPA</th>
						    <th width = "5%" align = "center">CGPA</th>
						    <th width = "5%" align = "center">CCH</th>
						    <th width = "7%" align = "center">Previous<br>CGPA</th>
						    <th width = "7%" align = "center">Previous<br>CCH</th>
						    <th width = "21%" align = "center">Remarks</th>

						    </tr>';
			$html .= '</thead>';
			for ($i = 0; $i < $temp_mark_size[$j]; $i++) {
				$html .= '<tr>';
				$html .= '<td width = "2%" align = "center">' . $sl++ . '</td>';
				$html .= '<td width = "8%" align = "center">' . $co_code[$f] . '</td>';
				$html .= '<td width = "15%" align = "center">' . $course_title[$f] . '</td>';
				$html .= '<td width = "4%" align = "center">' . $credit_hour[$f] . '</td>';
				$html .= '<td width = "7%" align = "center">' . $marks[$f] . '</td>';
				$html .= '<td width = "7%" align = "center">' . $letter_grade[$f] . '</td>';
				$html .= '<td width = "7%" align = "center">' . $grade_point[$f] . '</td>';
				$html .= '<td width = "5%" align = "center"></td>';
				$html .= '<td width = "5%" align = "center"></td>';
				$html .= '<td width = "5%" align = "center"></td>';
				$html .= '<td width = "7%" align = "center"></td>';
				$html .= '<td width = "7%" align = "center"></td>';
				$html .= '<td width = "21%" align = "center"></td>';
				$html .= '</tr>';
				$f++;
			}
			$html .= '<tr>';
			$html .= '<td width = "10%" align = "center"></td>';
			$html .= '<td width = "15%" align = "center"></td>';
			$html .= '<td width = "4%" align = "center"></td>';
			$html .= '<td width = "7%" align = "center"></td>';
			$html .= '<td width = "7%" align = "center"></td>';
			$html .= '<td width = "7%" align = "center"></td>';
			if ($temp_mark_size[$j] > 0) {
				$html .= '<td width = "5%" align = "center">' . $gpa[$j] . '</td>';
				$html .= '<td width = "5%" align = "center">' . $cgpa[$j] . '</td>';
				$html .= '<td width = "5%" align = "center">' . $cch[$j] . '</td>';
				$html .= '<td width = "7%" align = "center">' . $pcgpa[$j] . '</td>';
				$html .= '<td width = "7%" align = "center">' . $pcch[$j] . '</td>';
				$html .= '<td width = "21%" align = "center">';

				if ($total_count[$j] == 0) {
					$html .= '<p align = "center">Passed</p>';
				} else {
					$html .= 'F in ';
					for ($n = 0; $n < $total_count[$j]; $n++) {
						$html .= $total_fail[$count];
						if ($n != $total_count[$j] - 1) {
							$html .= ', ';
						}
						$count++;
					}
				}

				$html .= '</td>';
			} else if ($temp_mark_size[$j] == 0) {
				$html .= '<td width = "5%" align = "center"></td>';
				$html .= '<td width = "5%" align = "center"></td>';
				$html .= '<td width = "5%" align = "center"></td>';
				$html .= '<td width = "7%" align = "center"></td>';
				$html .= '<td width = "7%" align = "center"></td>';
				$html .= '<td width = "21%" align = "center"></td>';
			}

			$html .= '</tr>';
			$html .= '</table>';
			for ($p = 0; $p < 4; $p++) {
				$html .= '<br />';
			}
			for ($pp = 0; $pp < 10; $pp++) {
				$html .= '<span> </span>';
			}
			$html .= '<span style="text-decoration: overline;">Tabulator (1)</span>';

			for ($pp = 0; $pp < 30; $pp++) {
				$html .= '<span> </span>';
			}
			$html .= '<span style="text-decoration: overline;">Tabulator (2)</span>';

			for ($pp = 0; $pp < 30; $pp++) {
				$html .= '<span> </span>';
			}
			$html .= '<span style="text-decoration: overline;">Scrutinizer (3)</span>';

			for ($pp = 0; $pp < 30; $pp++) {
				$html .= '<span> </span>';
			}
			$html .= '<span>Date: 17/02/2022</span>';

			for ($pp = 0; $pp < 30; $pp++) {
				$html .= '<span> </span>';
			}
			$html .= '<span style="text-decoration: overline;">Deputy Controller of Examinations</span>';
			if ($j != count($name) - 1) {
				$html .= '<br pagebreak="true"/>';
				// $html .= '<p>Ashik</p>';
			}
		}

		$pdf = new Pdf('L', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('My Title');
		$pdf->setPageUnit('pt');
		//$document_width = $pdf->pixelsToUnits('100');
		//$document_height = $pdf->pixelsToUnits('100');
		$font_size = $pdf->pixelsToUnits('10');
		$pdf->SetFont('helvetica', '', $font_size, '', 'default', true);
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->AddPage('L');
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('result.pdf', 'I');
	}


	public function fetch()
	{
		$this->Result_Model->parse_excel_model();
	}

	public function convert_to_pdf()
	{
		$id = $_POST['pdf_id'];
		$mark = $_POST['pdf_mark'];
		$level = $_POST['level'];
		$semester = $_POST['semester'];
		$course_code = $_POST['course_code'];
		$credit_hour = $_POST['cre_hour'];

		$html = '';
		$html .= '<h3>Level: ' . $level . '</h3>';
		$html .= '<h3>Semester: ' . $semester . '</h3>';
		$html .= '<h3>Course Code: ' . $course_code . '</h3>';
		$html .= '<h3>Credit Hour: ' . $credit_hour . '</h3>';
		$html .= '<table border = "1">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<th>ID</th>';
		$html .= '<th>Marks</th>';
		$html .= '</tr>';
		$html .= '</thead>';

		for ($i = 0; $i < count($id); $i++) {
			$html .= '<tr>';
			$html .= '<td>' . $id[$i] . '</td>';
			$html .= '<td>' . $mark[$i] . '</td>';
			$html .= '</tr>';
		}
		$html .= '</table>';

		$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
		$pdf->SetTitle('My Title');
		$pdf->SetHeaderMargin(30);
		$pdf->SetTopMargin(20);
		$pdf->setFooterMargin(20);
		$pdf->SetAutoPageBreak(true);
		$pdf->SetAuthor('Author');
		$pdf->SetDisplayMode('real', 'default');
		$pdf->AddPage();
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->Output('download.pdf', 'I');
	}

	public function parse_excel()
	{
		echo "Value parsed successfully";
		$id = $_POST['id'];
		$mark = $_POST['marks'];
		$repeat_course = $_POST['repeat_course'];

		$level = $_POST['level'];
		$semester = $_POST['semester'];
		$course_code = $_POST['course_code'];
		$credit_hour = $_POST['credit_hour'];

		for ($i = 0; $i < count($id); $i++) {

			if ($mark[$i] >= 0 && $mark[$i] < 40) {
				$grade = "F";
				$gpa = 0.00;
				$credit = 0;
			} else {
				if ($mark[$i] >= 40 && $mark[$i] < 45) {
					$grade = "D";
					$gpa = 2.00;
				}
				if ($mark[$i] >= 45 && $mark[$i] < 50) {
					$grade = "C";
					$gpa = 2.25;
				}
				if ($mark[$i] >= 50 && $mark[$i] < 55) {
					$grade = "C+";
					$gpa = 2.50;
				}
				if ($mark[$i] >= 55 && $mark[$i] < 60) {
					$grade = "B-";
					$gpa = 2.75;
				}
				if ($mark[$i] >= 60 && $mark[$i] < 65) {
					$grade = "B";
					$gpa = 3.00;
				}
				if ($mark[$i] >= 65 && $mark[$i] < 70) {
					$grade = "B+";
					$gpa = 3.25;
				}
				if ($mark[$i] >= 70 && $mark[$i] < 75) {
					$grade = "A-";
					$gpa = 3.50;
				}
				if ($mark[$i] >= 75 && $mark[$i] < 80) {
					$grade = "A";
					$gpa = 3.75;
				}
				if ($mark[$i] >= 80 && $mark[$i] <= 100) {
					$grade = "A+";
					$gpa = 4.00;
				}
			}


			//Calculate GPA...

			$gpa_ccode_for_gpa['value'] = $this->Result_Model->fetch_gpa_cc_from_marks_table_for_gpa($id[$i], $level, $semester);

			$num_of_rows_for_gpa = $this->Result_Model->get_num_of_rows_marks_table_for_gpa($id[$i], $level, $semester);

			$gpa_multi_cch_for_gpa = 0;
			$total_credit_hr_for_gpa = 0;

			for ($j = 0; $j < $num_of_rows_for_gpa; $j++) {

				$c_code_for_gpa =  $gpa_ccode_for_gpa['value'][$j]['course_code'];

				$get_cch['value'] = $this->Result_Model->fetch_cch_from_syllabus_table($c_code_for_gpa);
				if ($gpa_ccode_for_gpa['value'][$j]['grade_point'] > 0)
					$total_credit_hr_for_gpa += $get_cch['value'][0]['credit_hour'];

				$gpa_multi_cch_for_gpa += ($get_cch['value'][0]['credit_hour'] * $gpa_ccode_for_gpa['value'][$j]['grade_point']);
			}

			$gpa_multi_cch_for_gpa += ($gpa * $credit_hour);
			if ($gpa > 0) {
				$total_credit_hr_for_gpa += $credit_hour;
			}

			if ($total_credit_hr_for_gpa == 0) $avg_gpa_for_gpa = 0;

			else
				$avg_gpa_for_gpa = $gpa_multi_cch_for_gpa / $total_credit_hr_for_gpa;

			$num_of_rows_in_marks_table = $this->Result_Model->check_id_lev_sem_co_code_exist_in_marks($id[$i], $level, $semester, $course_code);

			if ($num_of_rows_in_marks_table == 0) {
				//$t_id = $id[$i];
				if ($semester % 2 == 0) {
					$previous_level = $level;
					$previous_semester = $semester - 1;
				} else if ($semester % 2 == 1) {
					$previous_level = $level - 1;
					$previous_semester = $semester + 1;
				}
				$num_of_rows_for_prev_semester = $this->Result_Model->check_lev_sem_exist_in_marks($previous_level, $previous_semester);
				if (($level == 1 && $semester == 1) || ($num_of_rows_for_prev_semester != 0)) {
					$this->Result_Model->insert_data_into_marks_table($level, $semester, $course_code, $id[$i], $mark[$i], $grade, $gpa, $repeat_course[$i]);
				}
			}


			$num_of_rows_in_result_table = $this->Result_Model->check_id_lev_sem_exist($id[$i], $level, $semester);

			if ($num_of_rows_in_result_table != 0) {
				$this->Result_Model->update_cch_gpa_in_result_table($id[$i], $level, $semester, $avg_gpa_for_gpa);
			} else {
				//Check if previous semester exist or not...
				if ($level != 1) {
					$prev_level = $level - 1;
					if ($semester % 2 == 1) {
						$prev_semester = $semester + 1;
						$num_of_rows = $this->Result_Model->check_lev_sem_exist($prev_level, $prev_semester);
						if ($num_of_rows > 0) {
							$this->Result_Model->insert_id_level_sem_cch_gpa_in_result_table($id[$i], $level, $semester, $avg_gpa_for_gpa);
						} else echo "Can't be done";
					} else if ($semester % 2 == 0) {
						$prev_semester = $semester - 1;
						$num_of_rows = $this->Result_Model->check_lev_sem_exist($level, $prev_semester);
						if ($num_of_rows > 0) {
							$this->Result_Model->insert_id_level_sem_cch_gpa_in_result_table($id[$i], $level, $semester, $avg_gpa_for_gpa);
						} else echo "Can't be done";
					}
				} else if ($level == 1) {
					if ($semester == 2) {
						$prev_semester = $semester - 1;
						$num_of_rows = $this->Result_Model->check_lev_sem_exist($level, $prev_semester);
						if ($num_of_rows > 0) {
							$this->Result_Model->insert_id_level_sem_cch_gpa_in_result_table($id[$i], $level, $semester, $avg_gpa_for_gpa);
						} else echo "Can't be done";
					} else if ($semester == 1) {
						$this->Result_Model->insert_id_level_sem_cch_gpa_in_result_table($id[$i], $level, $semester, $avg_gpa_for_gpa);
					}
				}
			}


			$temp_level = $level;
			$temp_semester = $semester;
			$change_level = $level;
			$change_semester = $semester;
			$update_level = $change_level;


			$k = 1;
			$f = 0;
			$temp = 0;
			$total_credit_hr_for_update = 0;
			$gpa_multi_cch_for_cgpa_update = 0;

			while (1) {
				while (1) {
					$gpa_ccode_for_gpa['value'] = $this->Result_Model->fetch_gpa_cc_from_marks_table_for_gpa($id[$i], $temp_level, $temp_semester);

					$num_of_rows_for_gpa = $this->Result_Model->get_num_of_rows_marks_table_for_gpa($id[$i], $temp_level, $temp_semester);


					for ($j = 0; $j < $num_of_rows_for_gpa; $j++) {

						$c_code_for_gpa =  $gpa_ccode_for_gpa['value'][$j]['course_code'];

						$get_cch['value'] = $this->Result_Model->fetch_cch_from_syllabus_table($c_code_for_gpa);
						if ($gpa_ccode_for_gpa['value'][$j]['grade_point'] > 0)
							$total_credit_hr_for_update += $get_cch['value'][0]['credit_hour'];

						$gpa_multi_cch_for_cgpa_update += ($get_cch['value'][0]['credit_hour'] * $gpa_ccode_for_gpa['value'][$j]['grade_point']);
					}

					if ($f == 1) break;
					if ($temp_level == 1 && $temp_semester == 1) {
						$f = 1;
						break;
					}
					if ($temp_semester == 2) $temp_semester = 1;
					else if ($temp_semester == 1) {
						$temp_semester = 2;
						$temp_level -= 1;
					}
				}
				if ($total_credit_hr_for_update == 0) $cgpa = $gpa_multi_cch_for_cgpa_update / $credit_hour;

				else $cgpa = $gpa_multi_cch_for_cgpa_update / $total_credit_hr_for_update;

				if ($temp == 1) $this->Result_Model->update_cgpa_cch($id[$i], $update_level, $change_semester, $cgpa, $total_credit_hr_for_update);
				else if ($temp == 0) {
					$temp = 1;
					$this->Result_Model->update_cgpa_cch($id[$i], $update_level, $change_semester, $cgpa, $total_credit_hr_for_update);
				}

				if ($change_semester == 1) {
					$temp_semester = 2;
					$temp_level = $update_level;
					$change_semester = 2;
				} else if ($change_semester == 2) {
					$temp_semester = 1;
					$temp_level = $change_level + $k;
					$update_level = $change_level + $k;
					$change_semester = 1;
					$k += 1;
				}

				$num_of_rows = $this->Result_Model->check_id_lev_sem_exist($id[$i], $temp_level, $temp_semester);

				if ($num_of_rows == 0) break;
			}
		}
	}

	public function parse_excel_for_student()
	{

		$id = $_POST['id'];
		$registration = $_POST['registration'];
		$name = $_POST['name'];
		$session = $_POST['session'];
		$active_session = $_POST['active_session'];
		$subject = $_POST['subject'];
		$degree = $_POST['degree'];
		//echo count($id);

		for ($i = 0; $i < count($id); $i++) {
			$temp_id = $id[$i];
			$this->Result_Model->insert_data_to_student($temp_id, $registration[$i], $name[$i], $session[$i], $active_session[$i], $subject[$i], $degree[$i]);
		}
		echo "parsed successfully";
	}

	public function login_page()
	{
		$this->load->view('result/test_tcpdf');
	}

	public function login_successful()
	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		$username = $_POST['username'];
		$password = $_POST['password'];
		$data = $this->Result_Model->login_validation($username, $password);

		//echo $data;

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('result/login_form');
		} else if ($data != 0) {
			$this->load->view('result/login_successful_view');
		}
		//$this->load->view('result/login_successful_view');
	}
}

<?php
	class Result_Model extends CI_Model  {

		public function get_syllabus() {
			$query = $this->db->get('syllabus');
			return $query->result_array();
		}

		public function insert() {
			$profile = $this->input->post('profile');
			$semester = $this->input->post('semester');
			$level = $this->input->post('level');
			$course_code = $this->input->post('course_code');
			$course_title = $this->input->post('course_title');
			$credit_hour = $this->input->post('credit_hour');
			$subject = $this->input->post('subject');
			$degree = $this->input->post('degree');


			$query = array
				('profile' => $profile,
				'semester' => $semester,
				'level' => $level,
				'course_code' => $course_code,
				'course_title' => $course_title,
				'credit_hour' => $credit_hour,
				'subject' => $subject,
				'degree' => $degree
			);

			$this->db->insert('syllabus',$query);
		}

		public function get_session($session) {
			//$session = $this->input->post('sess');
			if($session == "") {
				$query = $this->db->get('student');
			}

			else {
				$query = $this->db->get_where('student',array('session' => $session));
			}

			return $query->result_array();
		}

		public function get_all_from_syllabus($profile) {
			$this->db->select();
			$this->db->from('syllabus');
			$this->db->where('profile', $profile);

			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_subject($subject) {
			if($subject == "") {
				$query = $this->db->get('student');
			}

			else {
				$query = $this->db->get_where('student',array('subject' => $subject));
			}

			return $query->result_array();
		}

		public function get_all_from_student() {
			$query = $this->db->get('student');
			return $query->result_array();
		}

		public function insert_student() {
			$id = $this->input->post('id');
			$registration = $this->input->post('registration');
			$name = $this->input->post('name');
			$session = $this->input->post('session');
			$subject = $this->input->post('subject');
			$degree = $this->input->post('degree');
			$profile = $this->input->post('profile');

			$query = array
				('id' => $id,
				'registration' => $registration,
				'name' => $name,
				'session' => $session,
				'subject' => $subject,
				'degree' => $degree,
				'profile' => $profile
			);
				$this->db->insert('student',$query);
		}

		public function mark_entry() {
			$this->db->select('student.id,student.registration,student.name,student.session,
				student.faculty,syllabus.course_code,syllabus.course_title');
			$this->db->from('syllabus');
			$this->db->join('student','student.profile=syllabus.profile','inner');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function pre_syllabus($profile) {
		//	$profile = $this->input->post('profile');
			$data = array('profile' => $profile);
			$query = $this->db->get_where('syllabus',$data);
			return $query->result_array();
		}

		public function syllabus_assign($subject,$session,$degree,$syllabus) {
				$data = array('profile' => $syllabus);

				$this->db->where('subject',$subject);
				$this->db->where('session',$session);
				$this->db->where('degree',$degree);

				$this->db->update('student',$data);
		}

		public function course_list($subject,$semester,$level,$ace) {
			$this->db->select('course_code,level,semester');
			$this->db->from('syllabus');

			$this->db->where('subject',$subject);
			$this->db->where('semester',$semester);
			$this->db->where('profile',$ace);
			$this->db->where('level',$level);

			$query = $this->db->get();


			return $query->result_array();

		}

		public function get_id_session($session) {
				$this->db->select('id,session');
				$this->db->from('student');
				$this->db->where('session',$session);
				$query1 = $this->db->get();
				return $query1->result_array();
			//	$r1 = $query1->result();		
		}

		public function insert_level($level,$semester) {
			$this->db->select('level,semester');
			$this->db->from('syllabus');
			$this->db->where('level',$level);
			$this->db->where('semester',$semester);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function insert_code($course_code) {
				$this->db->select('course_code,credit_hour');
				$this->db->from('syllabus');
				$this->db->where('course_code',$course_code);
				$query2 = $this->db->get();
				//$r2 = $query2->result();
				return $query2->result_array();
		}

		public function insert_credit() {

		}

		public function get_marks($get_number,$get_id,$cumm_credit,$grade,$gpa,$course_co,$temp) {
			$query = array(
				'marks' => $get_number,
				'grade_point' => $gpa,
				'cumm_credit' => $cumm_credit,
				'letter_grade' => $grade,
				'cumm_credit' => $temp
			);
			$this->db->where('id',$get_id);
			$this->db->where('course_code',$course_co);

			$this->db->update('marks',$query);

		//	$this->db->insert('marks',$query);
		}

		public function test($id) {
			$this->db->select();
		}

		public function insert_syllabus() {
				$profile = $this->input->post('profile');
				$semester = $this->input->post('semester');
				$level = $this->input->post('level');
				$course_code = $this->input->post('course_code');
				$course_title = $this->input->post('course_title');
				$credit_hour = $this->input->post('credit_hour');
				$subject = $this->input->post('subject');
				$degree = $this->input->post('degree');

				$query = array(
				'profile' => $profile,
				'semester' => $semester,
				'level' => $level,
				'course_code' => $course_code,
				'course_title' => $course_title,
				'credit_hour' => $credit_hour,
				'subject' => $subject,
				'degree' => $degree
			);
				$this->db->insert('syllabus',$query);
		}

		public function delete_course() {
			$course_code = $this->input->post('course_code');
			$this->db->delete('syllabus',array('course_code' => $course_code));
		}

		public function get_profile($session,$subject) {
			$this->db->select('profile');
			$this->db->from('student');
			$this->db->where('session',$session);
			$this->db->where('subject',$subject);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_student_new() {
			$id = $this->input->post('id');
			$registration = $this->input->post('registration');
			$name = $this->input->post('name');
			$session = $this->input->post('session');
			$subject = $this->input->post('subject');
			$degree = $this->input->post('degree');
			$profile = $this->input->post('profile');

			$query = array(
				'id' => $id,
				'registration' => $registration,
				'name' => $name,
				'session' => $session,
				'subject' => $subject,
				'degree' => $degree,
				'profile' => $profile
			);
			$this->db->insert('student',$query);
		}

		public function delete_student() {
			$id = $this->input->post('id');
			$this->db->delete('student',array('id' => $id));
		}

		public function get_grading($get_id,$new_session,$new_semester,$new_level,$get_level,$get_semester,$get_course_code) {
			$this->db->select('credit_hour,cre_mul_gpa');
			$this->db->from('grading');
			$this->db->where('id',$get_id);
			$this->db->where('session',$new_session);
			$this->db->where('level',$new_level);
			$this->db->where('semester',$new_semester);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function set_grading($new_gpa,$new_credit,$new_mul_gpa,$get_id,$new_session,$new_semester,$new_level) {
			$query = array(
				'gpa' => $new_gpa,
				'credit_hour' => $new_credit,
				'cre_mul_gpa' => $new_mul_gpa
			);
			$this->db->where('id',$get_id);
			$this->db->where('level',$new_level);
			$this->db->where('semester',$new_semester);
			$this->db->where('session',$new_session);
			$this->db->update('grading',$query);
		}

		public function cch_update($cumm_credit,$get_id,$new_semester,$new_level,$new_session) {
			$query = array(
				'cch' => $cumm_credit
			);
			$this->db->where('id',$get_id);
			$this->db->where('level',$new_level);
			$this->db->where('semester',$new_semester);
			$this->db->where('session',$new_session);
			$this->db->update('cgpa_calculation',$query);
		}

		public function fetch_cg($cg_level,$cg_semester,$new_session,$get_id) {
			$this->db->select('cch,cgpa');
			$this->db->from('cgpa_calculation');
			$this->db->where('id',$get_id);
			$this->db->where('level',$cg_level);
			$this->db->where('semester',$cg_semester);
			$this->db->where('session',$new_session);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function final_cgpa($final_cgpa,$new_semester,$new_session,$get_id,$new_level) {
			$query = array(
				'cgpa' => $final_cgpa
			);
			$this->db->where('id',$get_id);
			$this->db->where('level',$new_level);
			$this->db->where('semester',$new_semester);
			$this->db->where('session',$new_session);
			$this->db->update('cgpa_calculation',$query);
		}

		public function insert_data_into_marks_table($get_level,$get_semester,$get_course_code,$get_id,$get_number,$grade,$gpa,$repeat_course) {
			$query = array(
				'id' => $get_id,
				'level' => $get_level,
				'semester' => $get_semester,
				'course_code' => $get_course_code,
				'marks' => $get_number,
				'grade_point' => $gpa,
				'letter_grade' => $grade,
				'repeat_course' => $repeat_course
			);

			$this->db->insert('marks',$query);
		}

		public function insert_data_into_grading_table($get_id,$get_level,$get_semester,
			$new_session,$new_mul_gpa,$new_credit,$new_gpa) {

			$query = array(
				'id' => $get_id,
				'level' => $get_level,
				'semester' => $get_semester,
				'credit_hour' => $new_credit,
				'cre_mul_gpa' => $new_mul_gpa,
				'gpa' => $new_gpa,
				'session' => $new_session
			);

			$this->db->insert('grading',$query);
		}

		public function update_data_into_grading_table($get_id,$get_level,$get_semester,
							$new_session,$new_mul_gpa,$new_credit,$new_gpa) {
			$query = array(
				'credit_hour' => $new_credit,
				'cre_mul_gpa' => $new_mul_gpa,
				'gpa' => $new_gpa
			);

			$this->db->where('id',$get_id);
			$this->db->where('level',$get_level);
			$this->db->where('semester',$get_semester);
			$this->db->where('session',$new_session);
			$this->db->update('grading',$query);
		}

		public function get_student_info_for_result($temp_id) {
			$this->db->select('id,name,registration');
			$this->db->from('student');
			$this->db->where('id', $temp_id);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_profile_again($session) {
			$this->db->select('profile');
			$this->db->from('student');
			$this->db->where('session',$session);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_syllabus_data_for_result($final_profile,$sem,$level) {
			$this->db->select('course_code,course_title,credit_hour');
			$this->db->from('syllabus');
			$this->db->where('profile',$final_profile);
			$this->db->where('semester',$sem);
			$this->db->where('level',$level);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_marks_for_result($id,$level,$sem,$temp_course_code_2) {
			$this->db->select('marks,grade_point,letter_grade');
			$this->db->from('marks');
			$this->db->where('id',$id);
			$this->db->where('level',$level);
			$this->db->where('semester',$sem);
			$this->db->where('course_code',$temp_course_code_2);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_the_gpa($id,$session,$sem,$level) {
			$this->db->select('gpa');
			$this->db->from('grading');
			$this->db->where('id',$id);
			$this->db->where('session',$session);
			$this->db->where('level',$level);
			$this->db->where('semester',$sem);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function assign_test_syllabus() {
			 $query = $this->db->get('student');
			 return $query->result();
		}

		public function fetch_session($subject) {
		   		$this->db->select('session');
		   		$this->db->group_by('session');
		   		$this->db->from('student');
		   		$this->db->where('subject',$subject);
		   		$query = $this->db->get();

			  	$output = '<option value="">Select Session</option>';
			  	foreach ($query->result() as $row) {
			  	$output .= '<option value="'.$row->subject.'">'.$row->session.'</option>'; 
			  }
			  return $output;
			 } 
 

		public function update_profile($subject,$session,$profile) {
				$data = array('profile' => $profile);

				$this->db->where('subject',$subject);
				$this->db->where('session',$session);

				$this->db->update('student',$data);
		}

		public function fetch_profile($subject) {
			$this->db->select('profile');
			$this->db->group_by('profile');
			$this->db->from('syllabus');
			$this->db->where('subject',$subject);
			$query = $this->db->get();
			$output = '<option value="">Select Syllabus</option>';
			foreach ($query->result() as $row) {
			  	$output .= '<option value="'.$row->subject.'">'.$row->profile.'</option>';
			  }
			  return $output;
		}

		public function fetch_profile_for_course_code_model($subject,$session) {
			$this->db->select('profile');
			$this->db->from('student');
			$this->db->where('subject',$subject);
			$this->db->where('session',$session);
			$query = $this->db->get();
			return $query->row('profile');
		}

		public function fetch_profile_for_insert_marks_model($subject,$session) {
			$this->db->select('profile');
			$this->db->from('student');
			$this->db->where('subject',$subject);
			$this->db->where('session',$session);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function fetch_course_code_model($subject,$profile,$semester,$level) {
			$this->db->select('course_code');
			$this->db->from('syllabus');
			$this->db->where('subject',$subject);
			$this->db->where('semester',$semester);
			$this->db->where('level',$level);
			$this->db->where('profile',$profile);
			$query = $this->db->get();
			$output = '<option value="">Select Course Code</option>';
			foreach ($query->result() as $row) {
			  	$output .= '<option value="">'.$row->course_code.'</option>';
			  }
			  return $output;
		}

		public function fetch_id_subject_session_for_insert_mark_model($subject,$session,$active_session)  {
			$this->db->select('id,session,subject');
			$this->db->from('student');
			$this->db->where('subject',$subject);
			$this->db->where('active_session',$active_session);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function fetch_sem_model($subject,$semester,$course_code,$level)  {
			$this->db->select('semester,level,course_code,credit_hour');
			$this->db->from('syllabus');
			$this->db->where('subject',$subject);
			$this->db->where('semester',$semester);
			$this->db->where('level',$level);
			$this->db->where('course_code',$course_code);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function check_id_lev_sem_exist($get_id,$get_level,$get_semester) {
		/*	$this->db->select('id');
			$this->db->from('result');
			$this->db->where('id',$get_id);
			$this->db->where('level',$get_level);
			$this->db->where('semester',$get_semester);
			$query = $this->db->get();
			return $query->result();  */

			$this->db->where('id', $get_id);
			$this->db->where('level', $get_level);
			$this->db->where('semester', $get_semester);
			$num_rows = $this->db->count_all_results('result');
			return $num_rows;
		}

		public function insert_id_level_sem_cch_gpa_in_result_table($get_id,$get_level,$get_semester,$avg_gpa_for_gpa) {
			$query = array(
				'id' => $get_id,
				'level' => $get_level,
				'semester' => $get_semester,
				'gpa' => $avg_gpa_for_gpa
			);

			$this->db->insert('result',$query);
		}

		public function get_pcgpa($get_id,$use_level,$use_semester) {
			$this->db->select('cgpa');
			$this->db->from('result');
			$this->db->where('id',$get_id);
			$this->db->where('level',$use_level);
			$this->db->where('semester',$use_semester);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_pcch($get_id,$use_level,$use_semester) {
			$this->db->select('cch');
			$this->db->from('result');
			$this->db->where('id',$get_id);
			$this->db->where('level',$use_level);
			$this->db->where('semester',$use_semester);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_curr_cch($get_id,$get_level,$get_semester) {
			$this->db->select('cch');
			$this->db->from('result');
			$this->db->where('id',$get_id);
			$this->db->where('level',$get_level);
			$this->db->where('semester',$get_semester);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function update_cch_gpa_in_result_table($get_id,$get_level,$get_semester,$avg_gpa_for_gpa) {
			$data = array('gpa' => $avg_gpa_for_gpa);

			$this->db->where('id',$get_id);
			$this->db->where('level',$get_level);
			$this->db->where('semester',$get_semester);

			$this->db->update('result',$data);
		}

		public function fetch_gpa_from_result_table($get_id,$get_level,$get_semester) {
			$this->db->select('gpa');
			$this->db->from('result');
			$this->db->where('id',$get_id);
			$this->db->where('level',$get_level);
			$this->db->where('semester',$get_semester);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function fetch_gpa_from_marks_table($get_id,$get_level,$get_semester) {
			$this->db->select('grade_point');
			$this->db->from('marks');
			$this->db->where('id',$get_id);
			$this->db->where('level',$get_level);
			$this->db->where('semester',$get_semester);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function fetch_gpa_cc_from_marks_table($get_id) {
			$this->db->select('grade_point,course_code');
			$this->db->from('marks');
			$this->db->where('id',$get_id);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_num_of_rows_marks_table($get_id) {
		//	$this->db->select('grade_point','course_code');
		//	$this->db->from('marks');
			$this->db->where('id',$get_id);
			$num_rows = $this->db->count_all_results('marks');
			return $num_rows;
		}

		public function get_num_of_rows_student() {
		//	$this->db->select('grade_point','course_code');
		//	$this->db->from('marks');
		//	$this->db->where('id',$get_id);
			$num_rows = $this->db->count_all_results('student');
			return $num_rows;
		}

		public function fetch_cch_from_syllabus_table($c_code) {
			$this->db->select('credit_hour');
			$this->db->from('syllabus');
			$this->db->where('course_code',$c_code);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function update_gpa_cch_into_result_table($avg_gpa,$get_id,$get_level,$get_semester,$credit_hour) {

				$data = array('gpa' => $avg_gpa,
					'cch' => $credit_hour);

				$this->db->where('id',$get_id);
				$this->db->where('level',$get_level);
				$this->db->where('semester',$get_semester);

				$this->db->update('result',$data);
		}

		public function get_num_of_rows_marks_table_for_gpa($get_id,$get_level,$get_semester) {
			$this->db->where('id',$get_id);
			$this->db->where('level',$get_level);
			$this->db->where('semester',$get_semester);
			$num_rows = $this->db->count_all_results('marks');
			return $num_rows;
		}

		public function fetch_gpa_cc_from_marks_table_for_gpa($id,$level,$semester) {
			$this->db->select('grade_point,course_code');
			$this->db->from('marks');
			$this->db->where('id',$id);
			$this->db->where('level',$level);
			$this->db->where('semester',$semester);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function update_marks($id,$mark,$course_code,$level,$semester,$gpa,$grade) {
			$data = array('marks' => $mark, 'grade_point' => $gpa, 'letter_grade' => $grade);

			$this->db->where('id',$id);
			$this->db->where('level',$level);
			$this->db->where('semester',$semester);
			$this->db->where('course_code',$course_code);
			

			$this->db->update('marks',$data);
		}

		public function update_cch_gpa_in_result_table_while_updating_marks($id,$level,$semester,$total_credit_hr_for_gpa,$avg_gpa_for_gpa,$p) {

			$data = array('gpa' => $avg_gpa_for_gpa,'cch' => $total_credit_hr_for_gpa);

			$this->db->where('id',$id);
			$this->db->where('level',$level);
			$this->db->where('semester',$semester);
		//	$this->db->where('course_code',$course_code);
			

			$this->db->update('result',$data);
		}

		public function check_id_lev_sem_exists($id,$level,$semester) {
		/*	$this->db->select('id');
			$this->db->from('result');
			$this->db->where('id',$get_id);
			$this->db->where('level',$get_level);
			$this->db->where('semester',$get_semester);
			$query = $this->db->get();
			return $query->result();  */

			$this->db->where('id', $id);
			$this->db->where('level', $level);
			$this->db->where('semester', $semester);
			$num_rows = $this->db->count_all_results('result');
			return $num_rows;
		}

		public function fetch_cre_hour_from_result_table($id,$level,$semester) {
			$this->db->select('cch');
			$this->db->from('result');
			$this->db->where('id',$id);
			$this->db->where('level',$level);
			$this->db->where('semester',$semester);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function check_lev_sem_exist($level,$semester) {
			$this->db->where('level', $level);
			$this->db->where('semester', $semester);
			$num_rows = $this->db->count_all_results('result');
			return $num_rows;
		}

		public function check_lev_sem_exist_in_marks($level,$semester) {
			$this->db->where('level', $level);
			$this->db->where('semester', $semester);
			$num_rows = $this->db->count_all_results('result');
			return $num_rows;
		}

		public function fetch_gpa_from_marks_table_for_editing($id,$level,$semester,$course_code) {
			$this->db->select('grade_point');
			$this->db->from('marks');
			$this->db->where('id',$id);
			$this->db->where('level',$level);
			$this->db->where('semester',$semester);
			$this->db->where('course_code',$course_code);
			$query = $this->db->get();
			return $query->result_array();
		}

		public function update_cgpa($id,$level,$semester,$cgpa,$total_credit_hr_for_update) {
			$data = array('cgpa' => $cgpa, 'cch' => $total_credit_hr_for_update);

			$this->db->where('id',$id);
			$this->db->where('level',$level);
			$this->db->where('semester',$semester);	

			$this->db->update('result',$data);
		}

		public function check_id_lev_sem_co_code_exist_in_marks($id,$level,$semester,$course_code) {
			$this->db->where('id', $id);
			$this->db->where('level', $level);
			$this->db->where('semester', $semester);
			$this->db->where('course_code', $course_code);
			$num_rows = $this->db->count_all_results('marks');
			return $num_rows;
		}

		public function check_prev_sem_data_exist($id,$level,$semester) {
			$this->db->where('id', $id);
			$this->db->where('level', $level);
			$this->db->where('semester', $semester);
			$num_rows = $this->db->count_all_results('marks');
			return $num_rows;
		}

		public function update_cgpa_cch($id,$level,$semester,$cgpa,$credit_hour) {
			$data = array('cgpa' => $cgpa, 'cch' => $credit_hour);

			$this->db->where('id',$id);
			$this->db->where('level',$level);
			$this->db->where('semester',$semester);	

			$this->db->update('result',$data);
		}

		public function get_the_active_session($session,$subject) {
			$this->db->select('active_session');
			$this->db->from('student');
			$this->db->where('session',$session);
			$this->db->where('subject',$subject);

			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_the_marks($active_session,$subject,$semester,$level,$course_code) {
			$this->db->select('marks');
			$this->db->from('marks');
			$this->db->where('session',$a);
			$this->db->where('subject',$subject);

			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_idsss($active_session,$subject) {
			$this->db->select('id');
			$this->db->from('student');
			$this->db->where('active_session',$active_session);
			$this->db->where('subject',$subject);

			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_the_mark($id,$level,$semester,$course_code) {
			$this->db->select('marks');
			$this->db->from('marks');
			$this->db->where('id',$id);
			$this->db->where('level',$level);
			$this->db->where('semester',$semester);
			$this->db->where('course_code',$course_code);

			$query = $this->db->get();
			return $query->row_array();
		}

		public function get_names($active_session,$subject) {
			$this->db->select('name');
			$this->db->from('student');
			$this->db->where('active_session',$active_session);
			$this->db->where('subject',$subject);

			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_registrations($active_session,$subject) {
			$this->db->select('registration');
			$this->db->from('student');
			$this->db->where('active_session',$active_session);
			$this->db->where('subject',$subject);

			$query = $this->db->get();
			return $query->result_array();
		}

		public function num_of_rows_for_name($active_session,$subject) {
			$this->db->where('active_session',$active_session);
			$this->db->where('subject',$subject);

			$num_rows = $this->db->count_all_results('student');
			return $num_rows;
		}

		public function get_mark_letter_gpa_co_code($id,$level,$semester) {
			$this->db->select('marks,grade_point,letter_grade,course_code');
			$this->db->from('marks');
			$this->db->where('id',$id);
			$this->db->where('level',$level);
			$this->db->where('semester',$semester);
			//$this->db->where('course_code',$course_code);


			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_profile_for_result_sheet($active_session,$subject) {
			$this->db->select('profile');
			$this->db->from('student');
			$this->db->where('active_session',$active_session);
			$this->db->where('subject',$subject);


			$query = $this->db->get();
			return $query->row_array();
		}

		public function get_course_title_hour($course_code) {
			$this->db->select('course_title,credit_hour');
			$this->db->from('syllabus');
			$this->db->where('course_code',$course_code);

			$query = $this->db->get();
			return $query->row_array();
		}

		public function get_gpa_cgpa_cch($id,$level,$semester) {
			$this->db->select('gpa,cch,cgpa');
			$this->db->from('result');
			$this->db->where('id',$id);
			$this->db->where('level',$level);
			$this->db->where('semester',$semester);

			$query = $this->db->get();
			return $query->row_array();
		}

		public function update_repeat_in_marks_table($required_id,$level,$semester,$co_code,$repeat_course) {
			$data = array('repeat_course' => $repeat_course);

			$this->db->where('id',$required_id);
			$this->db->where('level',$level);
			$this->db->where('semester',$semester);
			$this->db->where('course_code',$co_code);

			$this->db->update('marks',$data);
		}

		public function get_the_repeat_course($main_id,$level,$semester,$course_code) {
			$this->db->select('repeat_course');
			$this->db->from('marks');
			$this->db->where('id',$main_id);
			$this->db->where('level',$level);
			$this->db->where('semester',$semester);
			$this->db->where('course_code',$course_code);

			$query = $this->db->get();
			return $query->row_array();
		}

		public function insert_data_to_data_temp($xx) {
			$profile = $this->input->post('profile');

			$query = array
				('name' => $profile,
				'id' => $profile
			);

			$this->db->insert('data_temp',$query);
		}

		public function parse_excel_model() {
			$this->db->order_by('CustomerID','DESC');
			$query = $this->db->get('tbl_customer');
			return $query;
			$output = '<h3 align = "center">Total Data-'.$data->num_rows().'</h3>
			<table class = "table table-striped table-bordered">
				<tr>
					<th>Customer Name</th>			
					<th>Address</th>
					<th>City</th>
					<th>Postal Code</th>
					<th>Country</th>
				</tr>
			';
			foreach ($data->result() as $row) {
				$output .= '
					<tr>
						<td>'.$row->CustomerName.'</td>
						<td>'.$row->Address.'</td>
						<td>'.$row->City.'</td>
						<td>'.$row->PostalCode.'</td>
						<td>'.$row->Country.'</td>
					</tr>
				';
			}
			$output .= '</table>';
			echo $output;
		}

		public function insert_excel($marks,$id,$level,$semester,$course_code,$grade,$gpa) {
			$query = array(
				'marks' => $marks,
				'id' => $id,
				'level' => $level,
				'semester' => $semester,
				'course_code' => $course_code,
				'letter_grade' => $grade,
				'grade_point' => $gpa
			);
			$this->db->insert('marks',$query);
		}

		public function fetch_total_fail_from_marks($id) {
			$this->db->select('course_code');
			$this->db->from('marks');
			$this->db->where('id',$id);
			$this->db->where('letter_grade','F');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function get_all_session() {
			$this->db->select('session');
			$this->db->distinct();
			$query = $this->db->get('student');
			return $query->result_array();
		}

		public function get_all_subject() {
			$this->db->select('subject');
			$this->db->distinct();
			$query = $this->db->get('syllabus');
			return $query->result_array();
		}

		public function get_searched_id($id) {
			if($id == "") {
				$query = $this->db->get('student');
			}
			else {
			$query = $this->db->get_where('student',array('id' => $id));
			}
			return $query->result_array();
		}

		public function get_searched_name($name) {
			if($name == "") {
				$query = $this->db->get('student');
			}
			else {
			$query = $this->db->get_where('student',array('name' => $name));
			}
			return $query->result_array();
		}

		public function get_session_id_for_pdf($reg) {
			$this->db->select('session,id');
			$this->db->from('student');
			$this->db->where('registration' , $reg);
			$query = $this->db->get();
			return $query->row();
		}

		public function insert_data_to_student($id,$registration,$name,$session,$active_session,$subject,$degree)
		{
			$query = array(
				'id' => $id,
				'registration' => $registration,
				'name' => $name,
				'session' => $session,
				'active_session' => $active_session,
				'subject' => $subject,
				'degree' => $degree
			);
			$this->db->insert('student',$query);
		}

		public function login_validation($username,$password) {
			$this->db->where('username',$username);
			$this->db->where('password',$password);

			$num_rows = $this->db->count_all_results('login_info');
			return $num_rows;
		}

		public function get_profile_from_syllabus($faculty) {
				$this->db->select('profile');
				$this->db->distinct();
		   		$this->db->group_by('profile');
		   		$this->db->from('syllabus');
		   		$this->db->where('subject',$faculty);
		   		$query = $this->db->get();

		   		//$output = '';
			  	$output = '<option value="">---Select Profile---</option>';
			  	foreach ($query->result() as $row) {
			  	$output .= '<option value="'.$row->subject.'">'.$row->profile.'</option>'; 
			  }
			  return $output;
		}

		public function fetch_sem_lev_co_code_title_cre_hr_deg_from_syllabus($faculty,$profile) {
				$this->db->select('semester,level,course_code,course_title,credit_hour,degree');
		   		$this->db->from('syllabus');
		   		$this->db->where('subject',$faculty);
		   		$this->db->where('profile',$profile);

		   		$query = $this->db->get();
		   		return $query->result_array();
		}

		public function fetch_sem_lev_from_syllabus($faculty,$profile) {
				$this->db->select('semester,level');
				$this->db->distinct();
		   		$this->db->from('syllabus');
		   		$this->db->where('subject',$faculty);
		   		$this->db->where('profile',$profile);

		   		$query = $this->db->get();
		   		return $query->result_array();
		}

	}

?>
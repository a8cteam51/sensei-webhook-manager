<?php
/**
 * Hook that triggers when a student completes a quiz.
 * 
 */
function swm_sensei_user_quiz_submitted( $user_id, $quiz_id, $grade, $quiz_pass_percentage, $quiz_grade_type ) {
	$webhook_url = get_option( 'sensei_webhook_manager_url' );
	if ( empty( $webhook_url ) ) {
		return;
	}

	$student = get_userdata( $user_id );

	$quiz      = get_post( $quiz_id );
	$lesson_id = $quiz->post_parent;
	$lesson    = get_post( $lesson_id );

	$course_id = $lesson_course_id = get_post_meta( $lesson_id, '_lesson_course', true );
	$course    = get_post( $course_id );

	$module       = 'N/A';
	$course_terms = get_the_terms( $course->ID, 'module' );
	if ( is_array( $course_terms ) ) {
		$course_terms_names = array_column( $course_terms, 'name' );
		$module             = implode( ', ', $course_terms_names );
	}

	$body_data = array(
		'user_id'  => $student->data->ID,
		'email'    => $student->data->user_email,
		'username' => $student->data->user_login,
		'course'   => $course->post_title,
		'module'   => $module,
		'lesson'   => $lesson->post_title,
		'quiz_id'  => $quiz_id,
		'URL'      => '',
	);

	$post_args = array(
		'body' => $body_data,
	);

	$response = wp_remote_post( $webhook_url, $post_args );
}

$is_enabled = get_option( 'sensei_webhook_manager_user_quiz_submitted_hook' );
if ( empty( $is_enabled ) ) {
	add_action( 'sensei_user_quiz_submitted', 'swm_sensei_user_quiz_submitted', 10, 5 );
}

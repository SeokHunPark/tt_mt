<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class My_Dbconsole {
	
    public function __construct()
    {
		//echo "dbconsole contruct";
		$CI = & get_instance();
		$CI->load->helper('date');
		
		$CI->load->database('dev');
		
		$CI->load->model('userpush_model');
		$CI->load->model('userinfo_model');
		$CI->load->model('userinven_model');
		$CI->load->model('userupgrade_model');
		$CI->load->model('useritem_model');
		$CI->load->model('useraction_model');
		$CI->load->model('usersupporters_model');
		$CI->load->model('mail_model');
		$CI->load->model('userchallenges_model');
		
		$CI->load->model('logcu_model');
    }
	
	public function get_logcu($select, $limit)
	{
		$CI = & get_instance();
		$logcu = $CI->logcu_model->get_logcu($select, $limit);
		return $logcu;
	}
	
	public function get_userpush($user_id)
	{
		$CI = & get_instance();
		$infos = $CI->userpush_model->get_userpush($user_id);
		return $infos;
	}
	
	public function get_userinfo($user_id)
	{
		$CI = & get_instance();
		$infos = $CI->userinfo_model->get_userinfo($user_id);
		return $infos;
	}
	
	public function get_userinven($user_id)
	{
		$CI = & get_instance();
		$infos = $CI->userinven_model->get_userinven($user_id);
		return $infos;
	}
	
	public function get_userupgrade($user_id)
	{
		$CI = & get_instance();
		$infos = $CI->userupgrade_model->get_userupgrade($user_id);
		return $infos;
	}
	
	public function get_useritems($user_id)
	{
		$CI = & get_instance();
		$infos = $CI->useritem_model->get_useritems($user_id);
		return $infos;
	}
	
	public function get_useraction($user_id)
	{
		$CI = & get_instance();
		$infos = $CI->useraction_model->get_useraction($user_id);
		return $infos;
	}
	
	public function get_usersupporters($user_id)
	{
		$CI = & get_instance();
		$infos = $CI->usersupporters_model->get_usersupporters($user_id);
		return $infos;
	}
	
	public function get_mail($user_id)
	{
		$CI = & get_instance();
		$infos = $CI->mail_model->get_mail($user_id);
		return $infos;
	}
	
	public function get_userchallenges($user_id)
	{
		$CI = & get_instance();
		$infos = $CI->userchallenges_model->get_userchallenges($user_id);
		return $infos;
	}
	
	public function delete_user_table_data($user_id, $table_name)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->delete($table_name);
	}
	
	public function update_user_info($user_id, $gas, $coin, $gold, $vgold, $chip, $exp, $stage, 
				$trophy, $challenge, $friend, $ticket, $gas_fill_secs, $basis_color, $status)
	{
		$CI = & get_instance();
		
		#UPDATE `test`.`user_info` SET `gas`='35' WHERE `uid`='13726';
		$CI->db->where('user_id', $user_id);
		$CI->db->set('gas', $gas);
		$CI->db->set('coin', $coin);
		$CI->db->set('gold', $gold);
		$CI->db->set('vgold', $vgold);
		$CI->db->set('chip', $chip);
		$CI->db->set('exp', $exp);
		$CI->db->set('trophy', $trophy);
		$CI->db->set('challenge', $challenge);
		$CI->db->set('friend', $friend);
		$CI->db->set('ticket', $ticket);
		$CI->db->set('gas_fill_secs', $gas_fill_secs);
		$CI->db->set('basis_color', $basis_color);
		$CI->db->set('status', $status);
		$CI->db->update('user_info');
	}
	
	public function update_user_inven($user_id, $model_id, $exp, $upgrade, $sel_color, $sel_skin, $up_0, $up_1, $up_2, $up_3, $point, $gr_0, $gr_1, $gr_2)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->where('model_id', $model_id);
		$CI->db->set('exp', $exp);
		$CI->db->set('upgrade', $upgrade);
		$CI->db->set('sel_color', $sel_color);
		$CI->db->set('sel_skin', $sel_skin);
		$CI->db->set('up_0', $up_0);
		$CI->db->set('up_1', $up_1);
		$CI->db->set('up_2', $up_2);
		$CI->db->set('up_3', $up_3);
		$CI->db->set('point', $point);
		$CI->db->set('gr_0', $gr_0);
		$CI->db->set('gr_1', $gr_1);
		$CI->db->set('gr_2', $gr_2);
		$CI->db->update('user_inven');
	}
	
	public function delete_user_inven($user_id, $model_id)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->where('model_id', $model_id);
		$CI->db->delete('user_inven');
	}
	
	public function delete_all_user_inven($user_id)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->delete('user_inven');
	}
	
	public function insert_user_inven($user_id, $model_id, $exp, $upgrade, $sel_color, $sel_skin, $up_0, $up_1, $up_2, $up_3)
	{
		$CI = & get_instance();
		
		$CI->db->set('user_id', $user_id);
		$CI->db->set('model_id', $model_id);
		$CI->db->set('exp', $exp);
		$CI->db->set('upgrade', $upgrade);
		$CI->db->set('sel_color', $sel_color);
		$CI->db->set('sel_skin', $sel_skin);
		$CI->db->set('up_0', $up_0);
		$CI->db->set('up_1', $up_1);
		$CI->db->set('up_2', $up_2);
		$CI->db->set('up_3', $up_3);
		$CI->db->insert('user_inven');
	}
	
	public function init_user_upgrade($user_id)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->delete('user_upgrade');
	}
	
	public function update_user_upgrade($user_id, $car_id, $parts, $step, $start_time, $expire_time)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->where('car_id', $car_id);
		$CI->db->set('parts', $parts);
		$CI->db->set('step', $step);
		$CI->db->set('start_time', $start_time);
		$CI->db->set('expire_time', $expire_time);
		$CI->db->update('user_upgrade');
	}
	
	public function delete_user_upgrade($user_id, $car_id, $parts, $step)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->where('car_id', $car_id);
		$CI->db->where('parts', $parts);
		$CI->db->where('step', $step);
		$CI->db->delete('user_upgrade');
	}
	
	public function insert_user_upgrade($user_id, $car_id, $parts, $step, $time, $expire_time, $reg_date)
	{
		$CI = & get_instance();
		
		$CI->db->set('user_id', $user_id);
		$CI->db->set('car_id', $car_id);
		$CI->db->set('parts', $parts);
		$CI->db->set('step', $step);
		$CI->db->set('start_time', $time);
		$CI->db->set('expire_time', $expire_time);
		$CI->db->set('reg_date', $reg_date);
		$CI->db->insert('user_upgrade');
	}
	
	public function init_user_item($user_id)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->delete('user_items');
		
		$item_code = 22;
		$count = 5;
		$expire = 0;
		$CI->db->set('user_id', $user_id);
		$CI->db->set('item_code', $item_code);
		$CI->db->set('count', $count);
		$CI->db->set('expire', $expire);
		$CI->db->insert('user_items');
	}
	
	public function update_user_item($user_id, $item_code, $count, $expire)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->where('item_code', $item_code);
		$CI->db->set('count', $count);
		$CI->db->set('expire', $expire);
		$CI->db->update('user_items');
	}
	
	public function delete_user_item($user_id, $item_code)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->where('item_code', $item_code);
		$CI->db->delete('user_items');
	}
	
	public function insert_user_item($user_id, $item_code, $count, $expire)
	{
		$CI = & get_instance();
		
		$CI->db->set('user_id', $user_id);
		$CI->db->set('item_code', $item_code);
		$CI->db->set('count', $count);
		$CI->db->set('expire', $expire);
		$CI->db->insert('user_items');
	}
	
	public function update_user_action($user_id, $current, $sel_car, $actions, $open_supporter, $tutorial, $num_conn, $num_game,  
						$winning_streak_opened, $winning_streak_time, $winning_streak, $winning_renewal, $winning_renewal_cooltime,
						$up_point, $max_up_point, $up_fill_secs, $gacha_time, $gacha_count, $autoplay_renew, $autoplay_count,
						$arena_renew, $arena_count, $rank_point, $rec_win, $rec_lose, $event_step)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		
		$CI->db->set('current', $current);
		$CI->db->set('sel_car', $sel_car);
		$CI->db->set('actions', $actions);
		$CI->db->set('open_supporter', $open_supporter);
		$CI->db->set('tutorial', $tutorial);
		$CI->db->set('num_conn', $num_conn);
		$CI->db->set('num_game', $num_game);
		$CI->db->set('winning_streak_opened', $winning_streak_opened);
		$CI->db->set('winning_streak_time', $winning_streak_time);
		$CI->db->set('winning_streak', $winning_streak);
		$CI->db->set('winning_renewal', $winning_renewal);
		$CI->db->set('winning_renewal_cooltime', $winning_renewal_cooltime);
		$CI->db->set('up_point', $up_point);
		$CI->db->set('max_up_point', $max_up_point);
		$CI->db->set('up_fill_secs', $up_fill_secs);
		$CI->db->set('gacha_time', $gacha_time);
		$CI->db->set('gacha_count', $gacha_count);
		$CI->db->set('autoplay_renew', $autoplay_renew);
		$CI->db->set('autoplay_count', $autoplay_count);
		$CI->db->set('arena_renew', $arena_renew);
		$CI->db->set('arena_count', $arena_count);
		$CI->db->set('rank_point', $rank_point);
		$CI->db->set('rec_win', $rec_win);
		$CI->db->set('rec_lose', $rec_lose);
		$CI->db->set('event_step', $event_step);
		$CI->db->update('user_action');
	}
	
	public function delete_all_user_supporters($user_id)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->delete('user_supporters');
	}
	
	public function update_user_supporters($user_id, $model_id, $count, $done, $exp, $upgrade, $supporter_idx)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->where('model_id', $model_id);
		$CI->db->set('count', $count);
		$CI->db->set('done', $done);
		$CI->db->set('exp', $exp);
		$CI->db->set('upgrade', $upgrade);
		$CI->db->set('supporter_idx', $supporter_idx);
		$CI->db->update('user_supporters');
	}
	
	public function delete_user_supporters($user_id, $model_id)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->where('model_id', $model_id);
		$CI->db->delete('user_supporters');
	}
	
	public function insert_user_supporters($user_id, $model_id, $done, $exp, $upgrade, $reg_date)
	{
		$CI = & get_instance();
		
		$CI->db->set('user_id', $user_id);
		$CI->db->set('model_id', $model_id);
		$CI->db->set('done', $done);
		$CI->db->set('exp', $exp);
		$CI->db->set('upgrade', $upgrade);
		$CI->db->set('reg_date', $reg_date);
		$CI->db->insert('user_supporters');
	}
	
	public function update_mail($mail_idx, $sender_id, $sender_pid, $mail_type, 
		$send_ts, $title, $message, $link, $is_received, $item_string, $coupon, $event_idx)
	{
		$CI = & get_instance();
		
		$CI->db->where('mail_idx', $mail_idx);
		$CI->db->set('sender_id', $sender_id);
		$CI->db->set('sender_pid', $sender_pid);
		$CI->db->set('mail_type', $mail_type);
		$CI->db->set('send_ts', $send_ts);
		$CI->db->set('title', $title);
		$CI->db->set('message', $message);
		$CI->db->set('link', $link);
		$CI->db->set('is_received', $is_received);
		$CI->db->set('item_string', $item_string);
		$CI->db->set('coupon', $coupon);
		if ($event_idx != "")
			$CI->db->set('event_idx', $event_idx);
		$CI->db->update('mail');
	}
	
	public function delete_mail($mail_idx)
	{
		$CI = & get_instance();
		
		$CI->db->where('mail_idx', $mail_idx);
		$CI->db->delete('mail');
	}
	
	public function delete_all_mail($user_id)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->delete('mail');
	}
	
	public function insert_mail($user_id, $sender_id, $mail_type, 
		$send_ts, $title, $message, $is_received, $item_string, $reg_date)
	{
		$CI = & get_instance();
		
		$CI->db->set('user_id', $user_id);
		$CI->db->set('sender_id', $sender_id);
		$CI->db->set('mail_type', $mail_type);
		$CI->db->set('send_ts', $send_ts);
		$CI->db->set('title', $title);
		$CI->db->set('message', $message);
		$CI->db->set('is_received', $is_received);
		$CI->db->set('item_string', $item_string);
		$CI->db->set('reg_date', $reg_date);
		$CI->db->insert('mail');
	}
	
	public function update_user_challenges($user_id, $challenge, $stage, $rank)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->where('challenge', $challenge);
		$CI->db->set('stage', $stage);
		$CI->db->set('rank', $rank);
		$CI->db->update('user_challenges');
	}
	
	public function delete_user_challenges($user_id, $challenge)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->where('challenge', $challenge);
		$CI->db->delete('user_challenges');
	}
	
	public function delete_all_user_challenges($user_id)
	{
		$CI = & get_instance();
		
		$CI->db->where('user_id', $user_id);
		$CI->db->delete('user_challenges');
	}
	
	public function insert_user_challenges($user_id, $challenge, $stage, $rank)
	{
		$CI = & get_instance();
		
		$CI->db->set('user_id', $user_id);
		$CI->db->set('challenge', $challenge);
		$CI->db->set('stage', $stage);
		$CI->db->set('rank', $rank);
		$CI->db->insert('user_challenges');
	}
}

/* End of file Dbconsole.php */
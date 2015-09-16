<?php
$config = array(
           'load_table' => array(
                                    array(
                                            'field' => 'tablename',
                                            'label' => 'Tablename',
                                            'rules' => 'required|integer'
                                         )
                                ),
			'load_userpage' => array(
                                    array(
                                            'field' => 'user_id',
                                            'label' => 'UserID',
                                            'rules' => 'required|integer'
                                         )
                                ),
			'view_user_log' => array(
                                    array(
                                            'field' => 'user_id',
                                            'label' => 'UserID',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'limit',
                                            'label' => 'Limit',
                                            'rules' => 'integer'
                                         )
                                ),
			'log_admin' => array(
                                    array(
                                            'field' => 'admin_id',
                                            'label' => 'Admin ID',
                                            'rules' => 'required'
                                         )
                                ),
			'update_user_info' => array(
									array(
                                            'field' => 'gas',
                                            'label' => 'Gas',
                                            'rules' => 'required|integer'
                                         ),
                                    array(
                                            'field' => 'coin',
                                            'label' => 'Coin',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'gold',
                                            'label' => 'Gold',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'chip',
                                            'label' => 'Chip',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'trophy',
                                            'label' => 'Trophy',
                                            'rules' => 'required|integer'
                                         )
                                ),
			'update_user_inven' => array(
                                    array(
                                            'field' => 'model_id[]',
                                            'label' => 'Model ID',
                                            'rules' => 'required'
                                         ),
									array(
                                            'field' => 'sel_color[]',
                                            'label' => 'Selected Color',
                                            'rules' => 'required|integer'
                                         )
								),
			'insert_user_inven' => array(
                                    array(
                                            'field' => 'model_id_in',
                                            'label' => 'Model ID',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'sel_color_in',
                                            'label' => 'Selected Color',
                                            'rules' => 'required|integer'
                                         )
								),
			'update_user_upgrade' => array(
                                    array(
                                            'field' => 'car_id[]',
                                            'label' => 'Car ID',
                                            'rules' => 'required'
                                         ),
									array(
                                            'field' => 'parts[]',
                                            'label' => 'Selected Parts',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'step[]',
                                            'label' => 'Step',
                                            'rules' => 'required|integer'
                                         )
								),
			'insert_user_upgrade' => array(
                                    array(
                                            'field' => 'car_id_in',
                                            'label' => 'Car ID insert',
                                            'rules' => 'required'
                                         ),
									array(
                                            'field' => 'parts_in',
                                            'label' => 'Selected Parts insert',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'step_in',
                                            'label' => 'Step insert',
                                            'rules' => 'required|integer'
                                         )
								),
			'update_user_item' => array(
                                    array(
                                            'field' => 'item_code[]',
                                            'label' => 'Item Code',
                                            'rules' => 'required'
                                         ),
									array(
                                            'field' => 'count[]',
                                            'label' => 'Count',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'expire[]',
                                            'label' => 'Expire',
                                            'rules' => 'required|integer'
                                         )
								),
			'insert_user_item' => array(
                                    array(
                                            'field' => 'item_code_in',
                                            'label' => 'Item code input',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'count_in',
                                            'label' => 'Count',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'expire_in',
                                            'label' => 'Expire',
                                            'rules' => 'required|integer'
                                         )
								),
			'update_user_action' => array(
									array(
                                            'field' => 'tutorial',
                                            'label' => 'Tutorial',
                                            'rules' => 'required|integer'
                                         )
								),
			'update_user_supporters' => array(
                                    array(
                                            'field' => 'model_id[]',
                                            'label' => 'Model ID',
                                            'rules' => 'required'
                                         ),
									array(
                                            'field' => 'done[]',
                                            'label' => 'done',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'upgrade[]',
                                            'label' => 'upgrade',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'exp[]',
                                            'label' => 'exp',
                                            'rules' => 'required|integer'
                                         )
								),
			'insert_user_supporter' => array(
                                    array(
                                            'field' => 'model_id_in',
                                            'label' => 'Model ID',
                                            'rules' => 'required'
                                         ),
									array(
                                            'field' => 'done_in',
                                            'label' => 'done',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'upgrade_in',
                                            'label' => 'upgrade',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'exp_in',
                                            'label' => 'exp',
                                            'rules' => 'required|integer'
                                         )
								),
			'update_mail' => array(
                                    array(
                                            'field' => 'userid',
                                            'label' => 'User ID',
                                            'rules' => 'required'
                                         ),
									array(
                                            'field' => 'sender_id[]',
                                            'label' => 'Sender ID',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'mail_type[]',
                                            'label' => 'Mail Type',
                                            'rules' => 'required'
                                         ),
									array(
                                            'field' => 'is_received[]',
                                            'label' => 'Is received',
                                            'rules' => 'required'
                                         ),
									array(
                                            'field' => 'item_string[]',
                                            'label' => 'Item String',
                                            'rules' => 'required'
                                         )
								),
			'insert_mail' => array(
                                    array(
                                            'field' => 'userid',
                                            'label' => 'User ID in',
                                            'rules' => 'required'
                                         ),
									array(
                                            'field' => 'item_string_in',
                                            'label' => 'Item String in',
                                            'rules' => 'required'
                                         )
								),
			'update_user_challenges' => array(
                                    array(
                                            'field' => 'challenge[]',
                                            'label' => 'Challenge',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'rank[]',
                                            'label' => 'Rank',
                                            'rules' => 'required|integer'
                                         )
								),
			'insert_user_challenges' => array(
                                    array(
                                            'field' => 'challenge_in',
                                            'label' => 'Challenge in',
                                            'rules' => 'required|integer'
                                         ),
									array(
                                            'field' => 'rank_in',
                                            'label' => 'Rank in',
                                            'rules' => 'required|integer'
                                         )
								)
						);
?>
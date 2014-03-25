<?php

$config = array(
	'security'		=> array(
			'user_class'		=> 	'Model\Metadata\UserEntity',
			'user_encoder'		=> 	'md5',
			'user_provider'		=>	'Model\Service\MyUserProvider',
	),
	
);
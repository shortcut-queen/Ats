<?php
/**
 * Created by PhpStorm.
 * User: SWX
 * Date: 2018/4/26
 * Time: 23:22
 */
use Ats\Service\UserService;
if(isset($_SESSION['user_id']))

UserService::selectScore($_SESSION['user_id']);
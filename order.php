<?php
function _mail ($from, $to, $subj, $what) {
	return mail($to, $subj, $what, 
	"From: $from
	Reply-To: $from
	Content-Type: text/plain; charset=windows-1251
	Content-Transfer-Encoding: 8bit");	
}
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post'):
	die('unsupported');
endif;
$options1 = array(
		'options' => array(
				'regexp' => '/^[А-Яа-яЁёA-Za-z0-9 .\-]+$/iu'
		)
);

$email = $_POST['email'];

if ($email === FALSE):
	$status = 'invalid';
else:
	$subscribe_str = $subscribe ? 'Да' : 'Нет';
	$destination_mail = 'dshel@ya.ru';
	$theme = 'Подписка на новости о Ёлке';
	$message = "Почта: {$email}";
	$status = _mail("support@elka27.ru", $destination_mail, $theme, $message) ? 'success' : 'error';
endif;

$invalid = array();
if (!$email) $invalid[] = 'email';

$data = array(
	'status' => $status,
	'invalid' => $invalid
);

header('Content-Type: application/json');
echo json_encode($data);

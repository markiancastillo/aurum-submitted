<?php
	include('../controllers/function.php');
	require $_SERVER['DOCUMENT_ROOT'] . '/aurum/lib/fpdf/fpdf.php';

	$accID = 1;
	$accountName = "Doe, Jane Lilith";
	$accountBaseRate = "50000";
	$allowanceMobile = "1230";
	$allowanceMed = "1231";
	$allowanceEcola = "1231";
	$grossPay = "99999";
	$sssTotal = "1231";
	$phPremium = "1231";
	$hdmfAmount = "1231";
	$dedIT = "1231";
	$dedAttendance = "1231";
	$netPay = "99999";

	generatePayrollPDF($accID, $accountName, $accountBaseRate, $allowanceMobile, $allowanceEcola, $allowanceMed, $grossPay, $sssTotal, $phPremium, $hdmfAmount, $dedIT, $dedAttendance, $netPay);
?>
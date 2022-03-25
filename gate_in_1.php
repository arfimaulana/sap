<?php

function pingAddress($ip)
{

    $koneksi = mysqli_connect("localhost", "root", "", "regio_personnel_2");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Koneksi database gagal : " . mysqli_connect_error();
    }

    $pingresult = exec("ping  -n 3 $ip", $outcome, $status);

    if (0 == $status) {
        // $status = "alive => ( " . print_r($outcome) . " )";
        $mysql = "UPDATE gate_status SET gate_status = 'Online', last_pinged = NOW() WHERE id = '1'";
        $koneksi->query($mysql);
    } else {
        // $status = "dead";
        $mysql = "UPDATE gate_status SET gate_status = 'Offline', last_pinged = NOW() WHERE id = '1'";
        $koneksi->query($mysql);
    }
    echo "<br>";
    echo "The IP address, $ip, is  " . $status;
}

$gate_in_1 = "10.126.26.179";
$gate_in_2 = "10.126.26.180";
$gate_in_3 = "10.126.26.181";
$gate_out_1 = "10.126.26.182";
$gate_out_2 = "10.126.26.183";

pingAddress($gate_in_1);

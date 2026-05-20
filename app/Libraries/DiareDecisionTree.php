<?php

namespace App\Libraries;

class DiareDecisionTree
{
    public function predict(array $jawaban)
    {
        // CEK DIARE
        $bab       = intval($jawaban['q0'] ?? 0);
        $fesesCair = intval($jawaban['q1'] ?? 0);
        $fesesLembek = intval($jawaban['q2'] ?? 0);
        $mual      = intval($jawaban['q3'] ?? 0);
        $muntah    = intval($jawaban['q4'] ?? 0);
        $demam     = intval($jawaban['q5'] ?? 0);
        $lemas     = intval($jawaban['q6'] ?? 0);
        $disentri  = intval($jawaban['q7'] ?? 0);

        // CEK DEHIDRASI
        $bibir     = intval($jawaban['q8'] ?? 0);
        $oliguria  = intval($jawaban['q9'] ?? 0);
        $mata      = intval($jawaban['q10'] ?? 0);
        $turgor    = intval($jawaban['q11'] ?? 0);
        $nadi      = intval($jawaban['q12'] ?? 0);
        $nafas     = intval($jawaban['q13'] ?? 0);
        $ubun      = intval($jawaban['q14'] ?? 0);

        /*
        ========================
        STATUS DIARE
        ========================
        */

        $statusDiare = false;

        if (
            ($bab == 1 && ($fesesCair == 1 || $fesesLembek == 1))
            || $disentri == 1
        ) {
            $statusDiare = true;
        }

        /*
        Kalau tidak diare, langsung stop
        */
        if (!$statusDiare) {
            return [
                'diare' => 'Tidak Diare',
                'dehidrasi' => 'Tidak Ada'
            ];
        }

        /*
        ========================
        STATUS DEHIDRASI
        ========================
        */

        $skor = $bibir + $oliguria + $mata + $turgor + $nadi + $nafas + $ubun;

        // BERAT
        if (
            ($oliguria && $nadi && $nafas)
            || ($mata && $turgor && $bibir && $ubun)
        ) {
            $statusDehidrasi = 'Berat';
        }

        // SEDANG
        elseif (
            ($mata && $bibir && $turgor)
            || $skor >= 3
        ) {
            $statusDehidrasi = 'Sedang';
        }

        // RINGAN
        elseif ($skor >= 1) {
            $statusDehidrasi = 'Ringan';
        }

        else {
            $statusDehidrasi = 'Tidak Ada';
        }

        return [
            'diare' => 'Diare',
            'dehidrasi' => $statusDehidrasi
        ];
    }
}
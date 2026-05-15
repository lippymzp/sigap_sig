<?php

namespace App\Libraries;

class DiareDecisionTree
{
    public function predict(array $jawaban)
    {
        $q0  = intval($jawaban['q0'] ?? 0);   // BAB > 5x
        $q1  = intval($jawaban['q1'] ?? 0);   // feses cair
        $q2  = intval($jawaban['q2'] ?? 0);   // feses lembek
        $q3  = intval($jawaban['q3'] ?? 0);   // lemas
        $q4  = intval($jawaban['q4'] ?? 0);   // ubun-ubun cekung
        $q5  = intval($jawaban['q5'] ?? 0);   // bibir kering
        $q6  = intval($jawaban['q6'] ?? 0);   // turgor menurun
        $q7  = intval($jawaban['q7'] ?? 0);   // nadi cepat
        $q8  = intval($jawaban['q8'] ?? 0);   // mata cekung
        $q9  = intval($jawaban['q9'] ?? 0);   // nafas cepat
        $q10 = intval($jawaban['q10'] ?? 0);  // oliguria
        $q11 = intval($jawaban['q11'] ?? 0);  // darah
        $q12 = intval($jawaban['q12'] ?? 0);  // mual
        $q13 = intval($jawaban['q13'] ?? 0);  // muntah
        $q14 = intval($jawaban['q14'] ?? 0);  // demam

        /*
        DECISION TREE
        */

        if ($q10 == 1) {
            return 'tinggi';
        }

        if ($q9 == 1 && $q8 == 1) {
            return 'tinggi';
        }

        if ($q7 == 1 && $q6 == 1) {
            return 'tinggi';
        }

        if ($q4 == 1 && $q5 == 1 && $q3 == 1) {
            return 'tinggi';
        }

        if ($q0 == 1 && $q1 == 1 && $q3 == 1) {
            return 'tinggi';
        }

        if (
            $q0 == 1 ||
            $q1 == 1 ||
            $q2 == 1 ||
            $q11 == 1 ||
            $q12 == 1 ||
            $q13 == 1 ||
            $q14 == 1
        ) {
            return 'sedang';
        }

        return 'rendah';
    }
}
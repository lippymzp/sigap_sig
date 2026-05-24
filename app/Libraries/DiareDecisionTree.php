<?php

namespace App\Libraries;

class DiareDecisionTree
{
    public function predict(array $jawaban)
    {
        // DIARE
        $bab          = intval($jawaban['q0'] ?? 0);
        $fesesCair    = intval($jawaban['q1'] ?? 0);
        $fesesLembek  = intval($jawaban['q2'] ?? 0);
        $mual         = intval($jawaban['q3'] ?? 0);
        $muntah       = intval($jawaban['q4'] ?? 0);
        $demam        = intval($jawaban['q5'] ?? 0);
        $lemas        = intval($jawaban['q6'] ?? 0);
        $disentri     = intval($jawaban['q7'] ?? 0);

        // DEHIDRASI
        $bibir        = intval($jawaban['q8'] ?? 0);
        $oliguria     = intval($jawaban['q9'] ?? 0);
        $mata         = intval($jawaban['q10'] ?? 0);
        $turgor       = intval($jawaban['q11'] ?? 0);
        $nadi         = intval($jawaban['q12'] ?? 0);
        $nafas        = intval($jawaban['q13'] ?? 0);
        $ubun         = intval($jawaban['q14'] ?? 0);

        /*
        ==========================
        STATUS DIARE
        ==========================
        */

        $skorDiare =
            $bab +
            $fesesCair +
            $fesesLembek +
            $mual +
            $muntah +
            $demam +
            $lemas +
            $disentri;

        if ($skorDiare == 0) {
            $statusDiare = 'Tidak';
        }
        elseif ($skorDiare <= 2) {
            $statusDiare = 'Ringan';
        }
        elseif ($skorDiare <= 5) {
            $statusDiare = 'Sedang';
        }
        else {
            $statusDiare = 'Berat';
        }

        /*
        ==========================
        STATUS DEHIDRASI
        ==========================
        */

        $skorDehidrasi =
            $bibir +
            $oliguria +
            $mata +
            $turgor +
            $nadi +
            $nafas +
            $ubun;

        $statusDehidrasi = $skorDehidrasi >= 2 ? 'Iya' : 'Tidak';

        return [
            'diare' => $statusDiare,
            'dehidrasi' => $statusDehidrasi
        ];
    }
}
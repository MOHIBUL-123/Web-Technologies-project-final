<?php

require_once __DIR__ .
'/../models/BorrowRecord.php';

require_once __DIR__ .
'/../models/Fine.php';




function generate_fines()
{
    $borrowModel =
        new BorrowRecord();

    $fineModel =
        new Fine();


    $records =
        $borrowModel->getOverdueBorrows();


    foreach($records as $record)
    {


        $today =
            new DateTime();

        $dueDate =
            new DateTime(
                $record['due_date']
            );

        $days =
            $today->diff($dueDate)->days;


        $amount =
            $days * 5;


        $fineModel->upsertFine(

            $record['id'],

            $record['member_id'],

            $amount,

            $days
        );
    }
}
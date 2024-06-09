<?php

use bot\Notifications\Notification;

$file = __DIR__ . '/fpik_schedule_api/ВТз-261с.json';

if (file_exists($file)) {
    var_dump($file);
    $allschedule = [];
    $text = '';
    $linez = 0;
    ////////////////////////
    $schedule = json_decode(file_get_contents($file), true);

    $btns = [];

    // {
    //
    // },
    $arr = [];

    $types_of_control = [

        'EXAM' => 'ЭКЗАМЕН',
        'CREDIT' => 'ЗАЧЕТ',
        'LECTURE' => 'Лекция',
        'PRACTICE' => 'Практика',
        'LABORATORY' => 'Лабораторка',
        'ALL' => 'ДАТА'

    ];

    $arr['title'] = 'ВТз-261с ' . $schedule['last_updated'] . ' (n4v parser)';
//last_updated
    foreach ($schedule['schedule'] as $datey => $lessons) {
        foreach ($lessons as $less) {
            //      if (in_array('EXAM', $less['type'])) {// || in_array('EXAM', $less['type'])

            $title = explode(' | ', $less['title']);

            var_dump($less['type']);

            $dat = [];

            foreach ($less['type'] as $item) {
                $dat[] = $types_of_control[$item];
            }

            $arr['data'][] = [
                'time' => $less['instructor'] ? explode(" ", $title[0], 2)[0] : null,
                "type" => $less['instructor'] ? implode(', ', $dat) : null,
                'subject' => $title[0],
                'instructor' => $less['instructor'],
                'room' => $less['room'],
                'date' => date('Y-m-d', strtotime($datey))
            ];


        }
        //   }
    }
//implode(' | ',
    echo $file = json_encode($arr, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    file_put_contents('ilya_apk_' . date('d_m_i') . '.json', $file);

}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report History</title>
</head>
<body>

    <div align="center" style="width:100%;">

        <img src="<?=base_url().$data_purpose[0]['image_purpose']?>" alt="No attachment" width="100" height="100">
        <h3><?=$data_purpose[0]['purpose']?></h3>
    
    </div>

    <table width="100%" style="border-bottom:1px solid grey;">
        <thead>
            <tr>
            <th>
                Estimasi dari <?=$data_purpose[0]['est_start']?> S.D <?=$data_purpose[0]['est_finish']?>
                <br>
                <?=$data_purpose[0]['est_interval']?>
            </th>
            <th>
                Dimulai Dari <?=$data_purpose[0]['real_start']?> S.D <?=$data_purpose[0]['real_finish']?>
                <br>
                <?=$data_purpose[0]['real_interval']?>
            </th>
            </tr>
        </thead>
    </table>
<br>    

    <div align="center" style="width:100%;">
        <table width="100%">
            <thead>
                <tr>
                    <?php
                        $no=0;
                        //print_r($data_helper);
                        foreach ($data_helper as $key => $value) {

                            $url_image = $value[$no]['image'] == "" ? "assets/image/user-profile-default.jpg" : $value[$no]['image'];

                            echo '
                                <th>
                                    <img src="'.base_url().$url_image.'" alt="No Image" width="100" height="100"></img>
                                    <br>
                                    '.$value[$no]['first_name'].' '.$value[$no]['last_name'].'
                                    <br>
                                    <br>
                                    '.$value[$no]['email'].'
                                    <br><br>';
                                    
                                    $getTaskByHelper = $this->M_crud->get_where('SP_TASK_PURPOSE', array('email_helper' => $value[0]['email'], 'id_purpose' => $data_purpose[0]['id_purpose']));
                                    
                                    echo '
                                    <table width="100%" border="1">
                                        <thead>
                                            <tr>
                                                <th>Task</th>
                                                <th>Start</th>
                                                <th>Finish</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            ';
                                                foreach ($getTaskByHelper->result() as $key => $value) {
                                                    echo '
                                                        <td>'.$value->task.'</td>
                                                        <td>'.date('d M Y', strtotime($value->start_date)).'</td>
                                                        <td>'.date('d M Y', strtotime($value->end_date)).'</td>
                                                    ';
                                                }
                                            echo '
                                            </tr>
                                        </tbody>
                                    </table>
                                    ';

                            echo'
                                </th>
                            ';       
                                    
                        }
                    ?>
                </tr>
            </thead>
        </table>
    </div>

    <h3><?=$data_purpose[0]['total_task']->num_rows()?> Tasks</h3>
    
</body>
</html>
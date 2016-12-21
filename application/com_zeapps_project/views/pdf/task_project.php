<html>
<header>
    <style>
        body {
            font-family: Verdana;
            font-size: 10pt;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #ffffff;
        }

        table, th, td {
            border: solid 1px #000000;
            /*text-align: center;*/
            padding: 3px;
        }

        h1 {
            font-size: 20pt;
            text-align: center;
        }

        h3 {
            border-bottom: solid 1px #000000;
            font-size: 12pt;
        }
        .descriptif {
            font-style: italic;
            color: #333333;
        }

    </style>
</header>
<body>
<div>

    <H1><?php echo "#" . $project->id . " - " . $project->company_name . " : " . $project->project_name ; ?></H1>


    <?php
    $tache_sans_section = false;
    foreach ($tasks as $task) {
        if ($task->id_section == 0) {
            $tache_sans_section = true;
            break;
        }
    }
    if ($tache_sans_section) {
        ?>
        <h3>Sans section</h3>

        <table>
            <thead>
            <tr>
                <th>#</th>
                <th i8n="Tâche"></th>
                <th i8n="Attribué à"></th>
                <th i8n="Échéance"></th>
                <th i8n="Avancement"></th>
            </tr>
            </thead>
            <tbody>


            <?php foreach ($tasks as $task) {
                if ($task->id_section == 0) {
                    ?>
                    <tr>
                        <td><?php echo $task->id ; ?></td>
                        <td><?php echo $task->title ; ?>
                            <?php if ($task->description != '') { ?>
                                <br>
                                <div class="descriptif">
                                <?php echo nl2br($task->description) ; ?>
                                </div>
                            <?php } ?>
                        </td>
                        <td><?php echo $task->name_assigned_to ; ?></td>
                        <td><?php if ($task->due_date && $task->due_date != '0000-00-00') {
                                $tabDate = explode("-", $task->due_date);
                                echo $tabDate[2] . "/" . $tabDate[1] . "/" . $tabDate[0] ;
                            } ?></td>
                        <td><?php echo $task->progress ; ?>%</td>
                    </tr>
                    <?php
                }
            }
            ?>

            </tbody>
        </table>

        <?php
    }
    ?>






    <?php
    foreach ($sections as $section) {
        //echo $section->name . "<br>" ;
        $tache_section = false;
        foreach ($tasks as $task) {
            //echo $task->id_section . "/" . $section->id . "<br>" ;
            if ($task->id_section == $section->id) {
                $tache_section = true;
                break;
            }
        }
        if ($tache_section) {
            ?>
            <h3><?php echo $section->name ; ?></h3>

            <table>
                <thead>
                <tr>
                    <th>#</th>
                    <th i8n="Tâche"></th>
                    <th i8n="Attribué à"></th>
                    <th i8n="Échéance"></th>
                    <th i8n="Avancement"></th>
                </tr>
                </thead>
                <tbody>


                <?php foreach ($tasks as $task) {
                    if ($task->id_section == $section->id) {
                        ?>
                        <tr>
                            <td><?php echo $task->id; ?></td>
                            <td><?php echo $task->title; ?>
                                <?php if ($task->description != '') { ?>
                                    <br>
                                    <div class="descriptif">
                                        <?php echo nl2br($task->description) ; ?>
                                    </div>
                                <?php } ?>
                            </td>
                            <td><?php echo $task->name_assigned_to; ?></td>
                            <td><?php if ($task->due_date && $task->due_date != '0000-00-00') {
                                    $tabDate = explode("-", $task->due_date);
                                    echo $tabDate[2] . "/" . $tabDate[1] . "/" . $tabDate[0] ;
                                } ?></td>
                            <td><?php echo $task->progress; ?>%</td>
                        </tr>
                        <?php
                    }
                }
                ?>

                </tbody>
            </table>

            <?php
        }
    }
    ?>



</div>
</body>
</html>
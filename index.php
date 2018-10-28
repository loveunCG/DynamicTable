<?php
$reults = [];

if ($_POST) {
    $posted_data = $_POST;
    foreach ($posted_data['id'] as $key => $value) {
        $reults[] = [
            'id' => $posted_data['id'][$key],
            'name' => $posted_data['name'][$key],
            'english' => $posted_data['english'][$key],
            'mathematic' => $posted_data['mathematic'][$key],
            'history' => $posted_data['history'][$key],
            'science' => $posted_data['science'][$key],
            'physics' => $posted_data['physics'][$key],
            'physics' => $posted_data['physics'][$key],
            'total' => $posted_data['total'][$key],
            'average' => $posted_data['average'][$key],
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Student Exam Marksheet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="description" content="Website description">
    <meta name="keywords" content="Site keywords">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="./assets/css/custom.css" type="text/css" media="screen" />
</head>

<body>
    <div class="container">

        <div class="card">
            <div class="card-header">
                <h1> Student Exam MarkSheet</h1>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" id="add_student" class="btn btn-primary float-right mb-3">Add Student</button>

                    </div>
                </div>
                <form class="student-table" method="POST">
                    <table class="table table-bordered" id="edit-exam-table">
                        <thead class="align-middle">
                            <tr>
                                <th class="align-middle text-center" rowspan="2" scope="col">No</th>
                                <th class="text-center" colspan="2" scope="col">Student</th>
                                <th class="text-center" colspan="5" scope="col">Subject's Score</th>
                                <th class="align-middle text-center" rowspan="2" scope="col">Total</th>
                                <th class="align-middle text-center" rowspan="2" scope="col">Average</th>
                            </tr>
                            <tr>
                                <th class="text-center" scope="col">ID</th>
                                <th class="text-center" scope="col">Name</th>
                                <th class="text-center" scope="col">English</th>
                                <th class="text-center" scope="col">Mathematic</th>
                                <th class="text-center" scope="col">History</th>
                                <th class="text-center" scope="col">Sciences</th>
                                <th class="text-center" scope="col">Physics</th>
                            </tr>
                        </thead>
                        <tbody class="exam-table-body">
                            <?php foreach ($reults as $key => $value): ?>
                                <tr>
                                    <td class="align-middle counterCell"></td>
                                    <td><input type="text" name="id[]" value="<?=$value['id']?>" class="input-field input-sm"></td>
                                    <td><input autocomplete="given-name" value="<?=$value['name']?>" type="text" name="name[]" class="input-field input-sm"></td>
                                    <td><input type="number" name="english[]" value="<?=$value['english']?>" class="input-field input-sm"></td>
                                    <td><input type="number" name="mathematic[]" value="<?=$value['mathematic']?>" class="input-field input-sm"></td>
                                    <td><input type="number" name="history[]" value="<?=$value['history']?>" class="input-field input-sm"></td>
                                    <td><input type="number" name="science[]" value="<?=$value['science']?>" class="input-field input-sm"></td>
                                    <td><input type="number" name="physics[]" value="<?=$value['physics']?>" class="input-field input-sm"></td>
                                    <td><input type="text" name="total[]" value="<?=$value['total']?>" class="input-field input-sm" readonly></td>
                                    <td><input type="text" name="average[]" value="<?=$value['average']?>" class="input-field input-sm" readonly></td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" onclick="onSubmit()" class="btn btn-success float-right mb-3">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/bootstrap.min.js"></script>
<script>
    var trBodyHtml =
        `
        <tr >
            <td class="counterCell align-middle"></td>
            <td><input type="text" name="id[]" class="input-field input-sm"></td>
            <td><input autocomplete="given-name" type="text" name="name[]" class="input-field input-sm"></td>
            <td><input type="number" onchange="inputScore(this)" name="english[]" class="input-field input-sm"></td>
            <td><input type="number" onchange="inputScore(this)" name="mathematic[]" class="input-field input-sm"></td>
            <td><input type="number" onchange="inputScore(this)" name="history[]" class="input-field input-sm"></td>
            <td><input type="number" onchange="inputScore(this)" name="science[]" class="input-field input-sm"></td>
            <td><input type="number" onchange="inputScore(this)" name="physics[]" class="input-field input-sm"></td>
            <td><input type="text" name="total[]" class="input-field  input-sm" readonly></td>
            <td><input type="text" name="average[]" class="input-field  input-sm" readonly></td>
        </tr>`;
    var index = 1;
    $(function () {
        $('#add_student').click(function () {
            console.log($('#tr-body'))
            $('.exam-table-body').append(trBodyHtml)
        });
    });

    $(
        'input[name="english[]"], input[name="mathematic[]"], input[name="history[]"], input[name="science[]"], input[name="physics[]"]'
    ).change(function (e) {
        var trParent = $(this).parent().parent();
        var english = trParent.find('input[name="english[]"]').val();
        var mathematic = trParent.find('input[name="mathematic[]"]').val();
        var history = trParent.find('input[name="history[]"]').val();
        var science = trParent.find('input[name="science[]"]').val();
        var physics = trParent.find('input[name="physics[]"]').val();
        var total = convertInt(english) + convertInt(mathematic) + convertInt(history) + convertInt(science) +
            convertInt(physics);
        trParent.find('input[name="total[]"]').val(total)
        trParent.find('input[name="average[]"]').val((total / 5).toFixed(2))
    });


    function inputScore(param) {
        var trParent = $(param).parent().parent();
        var english = trParent.find('input[name="english[]"]').val();
        var mathematic = trParent.find('input[name="mathematic[]"]').val();
        var history = trParent.find('input[name="history[]"]').val();
        var science = trParent.find('input[name="science[]"]').val();
        var physics = trParent.find('input[name="physics[]"]').val();
        var total = convertInt(english) + convertInt(mathematic) + convertInt(history) + convertInt(science) +
            convertInt(physics);
        trParent.find('input[name="total[]"]').val(total)
        trParent.find('input[name="average[]"]').val((total / 5).toFixed(2))
    }

    function convertInt(param) {
        if (isNaN(param) || param == '') {
            return 0;
        } else {
            return parseFloat(param)
        }
    }

    function onSubmit() {

        var fromData = $('.student-table').serialize()
        console.log(fromData)
        $('.student-table').submit()
    }
</script>

<style>
    input[type=number] {
        -moz-appearance: textfield;
    }

    table {
        counter-reset: tableCount;
    }

    .counterCell:before {
        content: counter(tableCount);
        counter-increment: tableCount;
    }

    thead {
        background-color: #e9ecef
    }

    .input-field {
        width: 100%;
        border: 1px solid #ced4da;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .table td,
    .table th {
        padding: .3rem;
    }

    input[name="total[]"],
    input[name="average[]"] {
        background-color: #e9ecef
    }

    input:focus {
        background-color: #CCFFFF
    }

    tr:hover {
        background-color: #FFFFCC
    }
</style>

</html>

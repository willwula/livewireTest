<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{--    CSS--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    <livewire:styles/>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-red shadow-sm">
        <div class="container col-mb-12">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Test2.3') }}
            </a>
            <div class="ml-auto">
                <a href="/show" class="mr-2">
                    使用者清單
                </a>
                <a href="/member" class="mr-2">
                    新增使用者資料
                </a>
            </div>
        </div>
    </nav>

    <main class="py-4">
        {{ $slot }}
    </main>
</div>
<livewire:scripts/>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.10.0/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function () { //初始
        console.log($('#datepicker'))
        $('#datepicker').datepicker({ //jq選擇器 #=id   datepicker是js function
            format: 'yyyy-mm-dd', // 設定日期格式
            autoclose: true, // 選擇日期後自動關閉 Datepicker
            todayHighlight: true // 高亮顯示當前日期
        }).on('changeDate', function (e) {
            console.log(e.format())
            // 使用 Livewire 的 emit 方法觸發日期變更事件
            Livewire.emit('dateSelected', e.format());
        });
    });
</script>

</body>
</html>

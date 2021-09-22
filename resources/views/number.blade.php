<main class="form-signin" style="justify-content: center; display: flex;">
    <div class="form-floating" style="text-align: center; width: 400px; margin-top: 300px">
        <div class="form-group" style="vertical-align: center; height: 500px">
            <div style="text-align: center">
                <label id="mainLabel" class="form-label" style="font-size: 28px">{{__('numbers.label')}}</label><br>
            </div>
            <div class="">
                <input id="number" class="form-control phoneClass" name="number" maxlength="15" style="border-radius: 4px"
                       onkeyup="showNumber()">
            </div>
            <div class="form-group" style="margin-top: 20px">
                <select id="selectLanguageButton" class="form-select" onchange="showNumber()">
                    <option id="en" value="en">English</option>
                    <option id="ru" value="ru">Русский</option>
                    <option id="ua" value="ua">Украинский</option>
                    <option id="de" value="de">Deutch</option>
                </select>
            </div>
            <div class="">
                <textarea id="result" class="form-control"
                          name="result" style="border: none; margin-top: 20px; height: 300px; resize: none; background-color: white"
                          readonly></textarea>
            </div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        function showNumber() {
            var number = $('#number').val();
            let lang = $('#selectLanguageButton').val();
            $.ajax({
                url: "{{ route('number') }}",
                method: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "number": number,
                    "lang": lang
                },
                success: function (data) {
                    if($('#number').val().length==0) {
                        $('#result').val('');
                    } else {
                        $('#result').val(data);
                    }
                }
            });
        }

        <!-- Phone mask -->
        $('body').on('keydown', '.phoneClass', function (e) {
            var key = e.which || e.charCode || e.keyCode || 0;
            $phone = $(this);

            return (key == 8 ||
                key == 9 ||
                key == 46 || key == 37 || key == 39 ||
                (key >= 48 && key <= 57) ||
                (key >= 96 && key <= 105));
        })
    </script>
</main>

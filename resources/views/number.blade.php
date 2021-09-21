<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
<main class="form-signin" style="justify-content: center; display: flex;">
    <div class="form-floating" style="text-align: center; width: 400px; margin-top: 300px">
        <div class="form-group" style="vertical-align: center; height: 500px">
            <div style="text-align: center">
                <label for="email" class="form-label">Введите номер</label><br>
            </div>
            <div class="">
                <input id="number" class="form-control" name="number" style="border-radius: 4px"
                >

            </div>
            <div class="form-group" style="margin-top: 20px">
                <select id="selectLanguageButton" class="form-select" >
                        <option id="ru" value="ru">Русский</option>
                        <option id="en" value="en">English</option>
                        <option id="en" value="ua">Украинский</option>
                        <option id="en" value="de">Deutch</option>
                </select>
            </div>
            <button class="btn btn-primary" type="button" style="margin-top: 20px" onclick="showNumber()">Преобразовать</button>
            <div class="">
                <textarea id="result" class="form-control"
                          name="email" style="border: none; margin-top: 20px; height: 300px; resize: none; background-color: white" readonly></textarea>
            </div>
        </div>
    </div>
    </div>
    </div>
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
                $('#result').val(data);
            }
        });
    }
</script>
</main>



<div class="border rounded shadow-lg p-3 mb-5 bg-white" style="width: 50%">
    <form action="/site/bejelentkezes" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Belépési Azonosító</label>
            <input name="azonosito" type="text" class="form-control" id="azonosito" aria-describedby="emailHelp" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Jelszó</label>
            <input name="jelszo" type="password" class="form-control" id="jelszo" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Bejelentkezés</button>
    </form>
</div>
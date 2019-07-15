<?
if (isset($_SESSION['auth']) && $_SESSION['auth'] == 'ok' ) {
?>
    <br><br><br>
    <div><a href="/auth/logout">Logout</a></div>
    <br><br>
    <div>
        <form action="/my_tasks/createShowTask">
            task: <input name="task" placeholder="Обязательное поле"><br>
            comments: <input name="comments"><br>
            deadline: <input name="deadline" type="date"><br>
            <button type="submit">Create</button>
        </form>
    </div>
<?
}
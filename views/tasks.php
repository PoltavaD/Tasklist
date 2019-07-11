<?
if (isset($_SESSION['auth']) && $_SESSION['auth'] == 'ok' ) {
?>
    <div><a href="logout.php">Logout</a></div>
    <br><br>
    <div>
        <form>
            task: <input name="task" placeholder="Обязательное поле"><br>
            comments: <input name="comments"><br>
            deadline: <input name="deadline" type="date"><br>
            <button type="submit">Create</button>
        </form>
    </div>
<?
}
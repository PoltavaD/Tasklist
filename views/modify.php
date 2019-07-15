<form>
    <input name= "id" type="hidden" value="<?=$_GET['id']?>">
    task: <input name="task" value="<?=$task['task']?>"><br>
    comments: <input name="comments" value="<?=$task['comments']?>"><br>
    deadline: <input name="deadline" type="date" value="<?=$task['deadline']?>"><br>
    <button type="submit" formaction="saveTask">modify</button>
</form>
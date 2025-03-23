
<!-- Project (Module 3) -->
<!-- # Project Requirements for Simple To-Do App -->
<!-- # Add Task -->
<!-- # Mark Task as Done/Undone -->
<!-- #Delete Task -->
<!-- #Save Tasks -->
<!-- # Redirect After Action -->
<!-- # UI Design (If you don't know HTML CSS please follow project's live class) -->
<!-- # File Handling in PHP -->
<!-- # Security -->


<?php
session_start();

$tasksFile = 'tasks.json';

// Load tasks from file
if (file_exists($tasksFile)) {
    $_SESSION['tasks'] = json_decode(file_get_contents($tasksFile), true) ?? [];
} else {
    $_SESSION['tasks'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['task'])) {
        $task = trim($_POST['task']);
        if ($task !== '') {
            $_SESSION['tasks'][] = ['text' => $task, 'done' => false];
        }
    } elseif (isset($_POST['toggle'])) {
        $index = (int)$_POST['toggle'];
        if (isset($_SESSION['tasks'][$index])) {
            $_SESSION['tasks'][$index]['done'] = !$_SESSION['tasks'][$index]['done'];
        }
    } elseif (isset($_POST['delete'])) {
        $index = (int)$_POST['delete'];
        if (isset($_SESSION['tasks'][$index])) {
            array_splice($_SESSION['tasks'], $index, 1);
        }
    }
    
    // Save tasks to file
    file_put_contents($tasksFile, json_encode($_SESSION['tasks'], JSON_PRETTY_PRINT));
    
    // Redirect to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
    <style>
        body {
            max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }
        .done {
            text-decoration: line-through;
            color: gray;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        form {
            display: inline;
        }
    </style>
</head>
<body>
    <h2>Task Manager</h2>
    <form method="POST">
        <input type="text" name="task" placeholder="Enter a new task..." required>
        <button type="submit" class="button-primary">Add Task</button>
    </form>
    
    <h3>Task List</h3>
    <ul>
        <?php foreach ($_SESSION['tasks'] as $index => $task): ?>
            <li>
                <span class="<?php echo $task['done'] ? 'done' : ''; ?>">
                    <?php echo htmlspecialchars($task['text']); ?>
                </span>
                <div>
                    <form method="POST" style="display:inline;">
                        <button type="submit" name="toggle" value="<?php echo $index; ?>">
                            <?php echo $task['done'] ? 'Undo' : 'Done'; ?>
                        </button>
                        <button type="submit" name="delete" value="<?php echo $index; ?>" class="button-danger" onclick="return confirm('Are you sure?');">
                            Delete
                        </button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>

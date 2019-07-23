<div class="task-comment">
  <div class="task-comment__content">
    <p><?=$taskComment->comment?></p>
  </div>
  <div class="task-comment-info">
    <p class="task-comment__creator"><?=$taskComment->creator->username?></p>
    <p class="task-comment__created">
      <?= is_null($taskComment->modified)
        ? $taskComment->created
        : $taskComment->modified ?>
    </p>
  </div>
</div>
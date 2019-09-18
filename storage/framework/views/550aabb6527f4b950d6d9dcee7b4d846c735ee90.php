<form id="transaction" action="/transaction/edit/<?php echo e($tr->id); ?>" method="post">
    <?php echo csrf_field(); ?>
<div class="modal-content">
    <h4>Edit <?php echo e($tr->type); ?></h4>
    <div class="row">
        <div class="col s6 offset-s3">
            <input type="hidden" name="trip_id" value="<?php echo e($tr->id); ?>">
        <?php if (\Entrust::can('date')) : ?>
        <div class="input-field">
            <input id="date" class="datepicker" name="date" required value="<?php echo e(date('Y-m-d', strtotime($tr->created_at))); ?>" type="text">
            <label for="date">Date</label>
        </div>
        <?php endif; // Entrust::can ?>
        <div class="input-field">
            <input id="detail" name="detail" required value="<?php echo e($tr->detail); ?>"  type="text">
            <label for="detail">Detail</label>
        </div>
        <div class="input-field">
            <input id="amount" name="amount" required value="<?php echo e($tr->amount); ?>" type="number">
            <label for="amount">Amount</label>
        </div>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="modal-action waves-effect waves-green btn-flat" type="submit">Save</button>
</div>
</form><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/transaction/edit.blade.php ENDPATH**/ ?>
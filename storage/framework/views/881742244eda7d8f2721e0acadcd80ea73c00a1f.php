<form id="transaction" action="/gexpense/add" method="post">
    <?php echo csrf_field(); ?>
<div class="modal-content">
    <h4>Add general expense</h4>
    <div class="row">
        <div class="col s6 offset-s3">
        <?php if (\Entrust::can('date')) : ?>
        <div class="input-field">
            <input id="date" class="datepicker" name="date" required value="<?php echo e(date('Y-m-d')); ?>" type="text">
            <label for="date">Date</label>
        </div>
        <?php endif; // Entrust::can ?>
        <div class="input-field">
            <input id="detail" name="detail" required  type="text">
            <label for="detail">Detail</label>
        </div>
        <div class="input-field">
            <input id="amount" name="amount" required  type="number">
            <label for="amount">Amount</label>
        </div>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button class="modal-action waves-effect waves-green btn-flat" type="submit">Save</button>
</div>
</form><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/expense/add.blade.php ENDPATH**/ ?>
<form id="transaction" action="/transaction/add" method="post">
    <?php echo csrf_field(); ?>
<div class="modal-content">
    <h4>Add <?php echo e($type); ?></h4>
    <div class="row">
        <div class="col s6 offset-s3">

    <?php if($type): ?>
        <input type="hidden" name="type" value="<?php echo e($type); ?>">
        <?php else: ?>
            <div class="input-field">
                <select name="type" required class="browser-default">
                    <option value="" disabled selected>Select Type</option>
                    <option value="income">Income</option>
                    <option value="expense">Expense</option>
                </select>
            </div>
    <?php endif; ?>
    <?php if($trip): ?>
            <input type="hidden" name="trip_id" value="<?php echo e($trip); ?>">
        <?php else: ?>
            <div class="input-field">
                <input id="trip" name="trip" required  type="text">
                <label for="trip">Trip</label>
            </div>
        <?php endif; ?>
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
</form>

<?php if(!$trip): ?>
    <script>
        $('#trip').autocomplete({
            data: <?php echo $data->toJson(); ?>,
        });
    </script>
    <?php endif; ?><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/transaction/add.blade.php ENDPATH**/ ?>
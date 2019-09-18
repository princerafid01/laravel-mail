
<div class="modal-content">
    <table class="striped">
        <tbody>
        <tr>
            <td><b class="strong text-black">Type</b></td>
            <td>General expense</td>
        </tr>
        <tr>
            <td><b class="strong text-black">Detail</b></td>
            <td><?php echo e($tr->detail); ?></td>
        </tr>
        <tr>
            <td><b class="strong text-black">Amount</b></td>
            <td><?php echo number_format($tr->amount, 2).' Tk.'; ?></td>
        </tr>
        <tr>
            <td><b class="strong text-black">Created by</b></td>
            <td><?php echo e($tr->created_by->name); ?></td>
        </tr>
        </tbody>

    </table>
</div>
<div class="modal-footer">
    <button class="modal-action modal-close waves-effect waves-green btn-flat" type="submit">Okay</button>
</div><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/expense/modal.blade.php ENDPATH**/ ?>
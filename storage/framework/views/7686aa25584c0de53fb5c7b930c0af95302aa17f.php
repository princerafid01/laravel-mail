<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col s12 m4 l4">
            <!-- Current Balance -->
            <div class="card animate fadeLeft">
                <div class="card-content">
                    <h4 class="card-title mb-0">Role</h4>
                    <form id="Role_form" class="col s12" method="post" action="<?php echo e(route('RolePost')); ?>" autocomplete="off">
                        <?php echo csrf_field(); ?>
                    <?php if($role): ?>
                        <p class="medium-small">Edit role</p>
                        <input type="hidden" name="role_id" value="<?php echo e($role->id); ?>">
                        <?php else: ?>
                        <p class="medium-small">Add new role</p>
                        <?php endif; ?>


                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="role_name" <?php if($role): ?> value="<?php echo e($role->display_name); ?>" <?php endif; ?> id="fn">
                                <label for="fn" class="">Role Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn cyan waves-effect waves-light right" type="submit" name="action"><?php if($role): ?>Update <?php else: ?> Create <?php endif; ?>
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col s12 m8 l8 animate fadeRight">
            <!-- Total Transaction -->
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title mb-0">Roles</h4>
                    <p class="medium-small">Manage, assign permission to role from here.</p>
                    <table>
                        <thead>
                        <tr>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>

                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($r->display_name); ?></td>
                                    <td><a class="tooltipped" data-position="top" data-tooltip="Change permission" href="<?php echo e(route('RolePermission', ['role_id'=>$r->id])); ?>"><i class="material-icons">tune</i></a> <a class="tooltipped" data-position="top" data-tooltip="Edit" href="<?php echo e(route('Role_edit', ['id'=>$r->id])); ?>"><i class="material-icons">edit</i></a> <a class="tooltipped" data-position="top" data-tooltip="Delete" href="<?php echo e(route('Role_delete', ['id'=>$r->id])); ?>"><i class="material-icons">delete</i></a></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>
<?php $__env->startSection('other_java'); ?>
    <script src="<?php echo e(asset('/')); ?>assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script>
        $("#Role_form").validate({
            rules: {
                role_name: {
                    required: true
                }
            },
            errorElement : 'div',
            errorPlacement: function(error, element) {
                var placement = $(element).data('error');
                if (placement) {
                    $(placement).append(error)
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp\htdocs\Laravel\resources\views/settings/role.blade.php ENDPATH**/ ?>
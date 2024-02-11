<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD Blog Laravel by Sintya </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="<?php echo e(route('posts.create')); ?>" class="btn btn-md btn-success mb-3">TAMBAH POST</a>
                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">GAMBAR</th>
                                <th scope="col">JUDUL</th>
                                <th scope="col">KATEGORI</th>
                                <th scope="col">CONTENT</th>
                                <th scope="col">AKSI</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="text-center">
                                        <img src="<?php echo e(Storage::url('public/posts/').$post->image); ?>" class="rounded" style="width: 150px">
                                    </td>
                                    <td><?php echo e($post->title); ?></td>
            
                                    <td><?php echo e($post->kategori_level); ?></td>
                                    

                                    <td><?php echo $post->content; ?></td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="<?php echo e(route('posts.destroy', $post->id)); ?>" method="POST">
                                            <a href="<?php echo e(route('posts.edit', $post->id)); ?>" class="btn btn-sm btn-primary">EDIT</a>
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>

                              <!-- jika data tidak tersedia   -->
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                  <div class="alert alert-danger">
                                      Data Post belum Tersedia.
                                  </div>
                              <?php endif; ?>
                            </tbody>
                          </table>  
                          <!-- menampilkan pagination -->
                          <?php echo e($posts->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        <?php if(session()->has('success')): ?>
        
            toastr.success('<?php echo e(session('success')); ?>', 'BERHASIL!'); 

        <?php elseif(session()->has('error')): ?>

            toastr.error('<?php echo e(session('error')); ?>', 'GAGAL!'); 
            
        <?php endif; ?>
    </script>

</body>
</html><?php /**PATH C:\BFLP IT\Bootcamp\Laravel\Portfolio\resources\views/posts/index.blade.php ENDPATH**/ ?>
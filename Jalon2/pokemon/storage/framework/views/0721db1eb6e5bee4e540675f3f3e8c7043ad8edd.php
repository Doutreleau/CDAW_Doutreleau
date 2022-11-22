

<?php $__env->startSection('content'); ?>
    <head>
        <script> $(document).ready( function () {   
                $('#Pokedex').DataTable();
        } );</script>
    </head>

    <h3>Pokédex</h3>
    <table id="Pokedex", class="display">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Image</th>
            <th>Energy 1</th>
            <th>Energy 2</th>
            <th>pv_max</th>
            <th>level</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        foreach ($pokemons as $pokemon) {
            ?>
           <tr>
            <td> <?php echo $pokemon->id; ?> </td>
            <td> <?php echo $pokemon->name; ?> </td>
            <td> <img src=<?php echo $pokemon->path; ?> /> </td>
            <td> <?php echo $pokemon->energy_1; ?> </td>
            <td> <?php echo $pokemon->energy_2; ?> </td>
            <td> <?php echo $pokemon->pv_max; ?> </td>
            <td> <?php echo $pokemon->level; ?> </td>
            </tr>
            <?php
        }        
        ?>
        </tbody>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\php\www\pokemon\resources\views/listePokemons.blade.php ENDPATH**/ ?>
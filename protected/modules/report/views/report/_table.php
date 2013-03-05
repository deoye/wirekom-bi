<div class="grid-view" cellpadding="0" cellspacing="0">
    <table class="item-class">
        <thead>
            <tr>
                <?php foreach ($data[0] as $key => $value) : ?>
                    <th><?php echo $key; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            <?php foreach ($data as $row) : ?>
                <tr class="<?php echo ($i % 2) ? "odd" : "even"; ?>">
                    <?php foreach ($row as $value): ?>
                        <td><?php echo $value; ?></td>                
                    <?php endforeach; ?>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
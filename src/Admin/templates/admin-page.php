<?php

use Digilopment\Cpa\Admin\AdminPage;

/** @var AdminPage $this */
?>
<div class="wrap">
    <h1 class="wp-heading-inline"><?php echo esc_html($this->pageTitle); ?></h1>
    <p class="description"><?php echo esc_html($this->description); ?></p>

    <?php if (empty($posts_data)) : ?>
        <div class="notice notice-success inline">
            <p>Žiadne podozrivé príspevky za posledných 30 dní.</p>
        </div>
    <?php else : ?>
        <table class="wp-list-table widefat fixed striped table-view-list posts">
            <thead>
                <tr>
                    <th scope="col" class="manage-column">Nadpis</th>
                    <th scope="col" class="manage-column">Autor</th>
                    <th scope="col" class="manage-column">Publikované</th>
                    <th scope="col" class="manage-column">Stav</th>
                    <th scope="col" class="manage-column">Úprava (backend)</th>
                    <th scope="col" class="manage-column">Frontend</th>
                </tr>
            </thead>
            <tbody id="the-list">
                <?php foreach ($posts_data as $post) : ?>
                    <tr>
                        <td><?php echo esc_html($post['title']); ?></td>
                        <td><?php echo esc_html($post['author']); ?></td>
                        <td><?php echo esc_html($post['date']); ?></td>
                        <td><?php echo esc_html($post['status']); ?></td>
                        <td>
                            <a href="<?php echo esc_url($post['edit_link']); ?>" class="button button-primary button-small">Upraviť</a>
                        </td>
                        <td>
                            <a href="<?php echo esc_url($post['view_link']); ?>" target="_blank" class="button button-secondary button-small">Zobraziť</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php namespace CoasterCms\Libraries\Blocks;

use CoasterCms\Helpers\Cms\Page\Path;
use PageBuilder;
use CoasterCms\Models\BlockSelectOption;
use CoasterCms\Models\Page;

class Selectpage extends Select
{
    /**
     * Populate select options with page names (also add no page option)
     * @param string $content
     * @return string
     */
    public function edit($content)
    {
        $parent = BlockSelectOption::where('block_id', '=', $this->_block->id)->where('option', '=', 'parent')->first();
        $parentPageId = !empty($parent) ? $parent->value : 0;
        $this->_editViewData['selectOptions'] = [0 => '-- No Page Selected --'] + Page::get_page_list(['parent' => $parentPageId]);
        return parent::edit($content);
    }

    /**
     * Get page name for search text instead of id
     * @param null|string $content
     * @return null
     */
    public function generateSearchText($content)
    {
        return Path::getById($content)->name ?: null;
    }

    /**
     * @param string $content
     * @param array $options
     * @return string
     */
    public function display($content, $options = [])
    {
        $pageOverride = PageBuilder::getData('pageOverride');
        PageBuilder::setData('pageOverride', Page::preload($content));
        $renderedView = parent::display($content, $options);
        PageBuilder::setData('pageOverride', $pageOverride);
        return $renderedView;
    }

}
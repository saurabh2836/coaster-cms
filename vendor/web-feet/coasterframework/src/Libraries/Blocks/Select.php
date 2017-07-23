<?php namespace CoasterCms\Libraries\Blocks;

use CoasterCms\Models\BlockSelectOption;

class Select extends String_
{
    /**
     * @var array
     */
    public static $blockSettings = ['Manage block select options' => 'themes/selects'];

    /**
     * Add return all option to the data function
     * @param string $content
     * @param array $options
     * @return array|string
     */
    public function data($content, $options = [])
    {
        if (isset($options['returnAll']) && $options['returnAll']) {
            return BlockSelectOption::getOptionsArray($this->_block->id);
        }
        return parent::data($content);
    }

    /**
     * Display select options, will fill in bg colour if hexadecimal
     * @param string $content
     * @return string
     */
    public function edit($content)
    {
        if (!array_key_exists('selectOptions', $this->_editViewData)) {
            $this->_editViewData['selectOptions'] = [];
            $selectOptions = BlockSelectOption::where('block_id', '=', $this->_block->id)->get();
            foreach ($selectOptions as $selectOption) {
                $this->_editViewData['selectOptions'][$selectOption->value] = $selectOption->option;
            }
            if (preg_match('/^#[a-f0-9]{6}$/i', key($selectOptions))) {
                $this->_editViewData['class'] = 'select_colour';
            }
        }
        return parent::edit($content);
    }

    /**
     * Save select option
     * @param array $postContent
     * @return static
     */
    public function submit($postContent)
    {
        return $this->save(isset($postContent['select']) ? $postContent['select'] : '');
    }

}
<?php

namespace BadChoice\Thrust\Fields;

class Select extends Field{

    protected $options = [];
    protected $allowNull = false;
    protected $searchable = false;

    public function options($options, $allowNull = false)
    {
        $this->options = $options;
        $this->allowNull = $allowNull;
        return $this;
    }

    public function searchable($searchable = true)
    {
        $this->searchable = $searchable;
        return $this;
    }

    protected function getOptions()
    {
        if ($this->allowNull) return array_merge(["" => "--"], $this->options);
        return $this->options;
    }

    public function allowNull($allowNull = true)
    {
        $this->allowNull = $allowNull;
        return $this;
    }

    public function displayInIndex($object)
    {
        return $this->getOptions()[$this->getValue($object)] ?? "--";
    }

    public function displayInEdit($object)
    {
        return view('thrust::fields.select',[
            'title' => $this->getTitle(),
            'field' => $this->field,
            'searchable' => $this->searchable,
            'value' => $this->getValue($object),
            'options' => $this->getOptions(),
        ]);
    }


}

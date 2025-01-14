<?php // lint >= 8.1

namespace Bug6864;

use function PHPStan\Testing\assertType;

class Model {

}

enum Foo {
	case Value;
}

/**
 * @template TModel of Model
 */
class ModelHelper {
	/**
	 * @var TModel
	 */
	private Model $model;

	/**
	 * @var TModel|null
	 */
	private ?Model $nullableModel;

	/**
	 * @param TModel $model
	 */
	public function __construct(Model $model) {
		$this->model = $model;
	}

	public function bug(): void {
		assertType('class-string<TModel of Bug6864\Model (class Bug6864\ModelHelper, argument)>', $this->model::class);
		assertType('class-string<TModel of Bug6864\Model (class Bug6864\ModelHelper, argument)>|null', $this->nullableModel::class);
	}
}

assertType('class-string<Bug6864\Foo>', Foo::Value::class);

<?php
/**
 * @version 2.0
 * @author Sammy
 *
 * @keywords Samils, ils, php framework
 * -----------------
 * @package Sammy\Packs\Func
 * - Autoload, application dependencies
 *
 * MIT License
 *
 * Copyright (c) 2020 Ysare
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace Sammy\Packs\Func {
  /**
   * Make sure the module base internal trait is not
   * declared in the php global scope defore creating
   * it.
   * It ensures that the script flux is not interrupted
   * when trying to run the current command by the cli
   * API.
   */
  if (!trait_exists ('Sammy\Packs\Func\Base')) {
  /**
   * @trait Base
   * Base internal trait for the
   * Func module.
   * -
   * This is (in the ils environment)
   * an instance of the php module,
   * wich should contain the module
   * core functionalities that should
   * be extended.
   * -
   * For extending the module, just create
   * an 'exts' directory in the module directory
   * and boot it by using the ils directory boot.
   * -
   */
  trait Base {
    /**
     * @var call
     * The closure object that
     * contains the function data
     */
    protected $call;

    public function __construct ($call = null) {
      $this->setCallBack ($call);
    }
    /**
     * @var setCallBack
     * Set a call back function
     * to this object
     */
    public function setCallBack ($call = null) {
      $this->call = is_callable ($call) ? $call : $this->call;
    }

    /**
     * @var setCallBack
     * Get the Closure object used
     * as the callback
     */
    public function getCallBack () {
      return $this->call;
    }

    /**
     * @var setCallBack
     * Execute the Closure object used
     * as the callback 4this object
     * based in an argument list
     */
    public function call () {
      return $this->callArray (func_get_args ());
    }

    /**
     * @var setCallBack
     * Execute the Closure object used
     * as the callback 4this object
     * based in an array
     */
    public function callArray ($args = null) {
      $args = is_array ($args) ? $args : [];
      return is_callable ($this->call) ? (
        call_user_func_array ($this->call, $args)
      ) : null;
    }

    public function __invoke () {
      return $this->callArray (func_get_args ());
    }
  }}
}

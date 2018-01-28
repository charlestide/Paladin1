

class RemoteHelper {

    /**
     * 创建一个Promise的catch函数
     *
     * @param vm vue实例
     * @param commit mutations方法
     * @param errorMessage 如果发生错误时，提示的信息
     * @param callback
     * @returns {function(*=)}
     */
    static createCatch(vm,commit,errorMessage,callback) {
        return error => {
            if (_.isFunction(callback)) {
                callback(error);
            }
            RemoteHelper.showRemoteError(vm,error);
            return Promise.reject(error);

        }
    }

    /**
     * 创建一个Promise的then函数，根据response中的status判断
     * 如果为true，则调用名为set的mutations，传入response中的data
     *
     * @param callback
     * @returns {function(*)}
     */
    static createThen(callback) {
        return response => {
            if (_.isFunction(callback)) {
                callback(response.data);
            }
            return response;
        }
    }

    /**
     * 通过element的message发出信息
     *
     * @param vm
     * @param data
     * @param message
     */
    static showRemoteMessage(vm,data,message = '') {
        let type = 'info';
        if (!message) {
            if (_.has(data,'data.message')) {
                message = data.data.message;
                type = data.status ? 'success' : 'error'
            } else {
                message = '未知信息';
            }
        }

        vm.$message({
            message: message,
            type: type
        });
    }

    /**
     * 通过element的message发出错误信息
     * @param vm
     * @param error
     * @param message
     */
    static showRemoteError(vm,error,message = '') {
        if (!message) {
            if (_.has(error, 'response.data.message')) {
                message = error.response.data.message;
            } else {
                message = '未知错误';
            }
        }
        console.error(error);

        vm.$message({
            message: message,
            type: 'error'
        });
    }


}

export default RemoteHelper;
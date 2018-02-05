
import * as mutationTypes from './mutation-types'
import * as actionTypes from './action-types'
import tasks from '../api/tasks'

export default {
  [actionTypes.FETCH_TASKS] (context) {
    context.commit(mutationTypes.SET_TASK, tasks.fetch())
  }
}

import {mount} from 'vue-test-utils'
import expect from 'expect'
import Users from '../../resources/assets/js/greygonz/components/Users.vue'
import moxios from 'moxios'

describe('Users', () => {
    let component

    const USERS = [
        {
            id: 1,
            name: 'Perropolesia',
            email: 'adfad@adfasdf.com'
        },
        {
            id: 2,
            name: 'Perropolesia2',
            email: 'adfad@adfasdf2.com'
        },
        {
            id: 3,
            name: 'Perropolesia3',
            email: 'adfad@adfasdf3.com'
        }
    ]

    beforeEach( () => {
        component = mount(Users)
        moxios.install()
    })

    afterEach( () => {
        moxios.uninstall()
    })

    it('expect users empty1', () => {
        expect(component.vm.users).toEqual([]);
    })

    it('Contains users', () => {
        expect(component.html()).toContain('Users (0):');

    })

    it('contains correct number of users after mount', done => {

        // prepare

        moxios.stubRequest('/api/v1/users', {
            status: 200,
            responseText: ''
        })

        // run

        // expect
        moxios.wait( () => {
            expect(component.vm.users).toEqual(USERS)
            expect(component.html()).toContain()
            done()
        })
    })

})
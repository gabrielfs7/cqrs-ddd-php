options({
    resultStreamName: "user-birthdays-result"
})
fromStream('cqrs_ddd_php')
.when({
    $init: function() {
        return {
            userId: 0,
            fullName: null,
            birthday: null
        }
    },
    userCreated: function(state, event) {
        if (event.body.birthday.length > 0) {
            state.userId = event.body.id;
            state.fullName = event.body.fullName;
            state.birthday = event.body.birthday;
        }
    }
})
.outputState()
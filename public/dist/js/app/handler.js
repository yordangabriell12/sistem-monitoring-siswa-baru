
class Handler {
	static elemClick = (el) => {
		return {
			el,
			id: el.getAttribute('id'),
		};
	}	
}


export { Handler };
